<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Resources\OfflineCallResource;
use App\Models\OfflineCall;
use Illuminate\Http\Request;

class OfflineCallController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $uid = auth()->user()->id;
        $calls = OfflineCall::where('user_id', $uid)->get();
        return response (OfflineCallResource::collection($calls));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'age' => 'required|numeric',
            'phone' => 'required|numeric',
            'problem' => 'required|string',
            'address' => 'required|string',
            'type' => 'required|string',
            'fees' => 'required|numeric',
            'area_id' => 'required|numeric',
        ]);

        $call = new OfflineCall();

        $call->name = $request->name;
        $call->age = $request->age;
        $call->phone = $request->phone;
        $call->problem = $request->problem;
        $call->address = $request->address;
        $call->type = $request->type;
        $call->fees = $request->fees;
        $call->user_id = auth()->user()->id;
        $call->status = 0;
        $call->area_id = $request->area_id;

        $call->save();
        return response (new OfflineCallResource($call));
    }
}
