<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Resources\OnlineCallResource;
use App\Models\OnlineCall;
use App\Models\User;
use Illuminate\Http\Request;

class OnlineCallController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $uid = auth()->user()->id;
        $calls = OnlineCall::where('user_id', $uid)->get();
        return response (OnlineCallResource::collection($calls));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'age' => 'required|numeric',
            'problem' => 'required|string',
            'type' => 'required|string',
            'fees' => 'required|numeric',
        ]);

        $call = new OnlineCall();

        $call->name = $request->name;
        $call->age = $request->age;
        $call->problem = $request->problem;
        $call->type = $request->type;
        $call->fees = $request->fees;
        $call->user_id = auth()->user()->id;
        $call->status = 0;
        $call->channel = '$request->status';
        $call->token = '$request->status';

        $call->save();
        return response (new OnlineCallResource($call));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function accept($id)
    {
        $call = OnlineCall::findOrFail($id);

        $call->status = 1;
        $call->docto_id = auth()->user()->id;
        return response (new OnlineCallResource($call));
    }
}
