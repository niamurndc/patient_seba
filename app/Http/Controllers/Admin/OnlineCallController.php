<?php

namespace App\Http\Controllers;

use App\Http\Resources\OnlineCallResource;
use App\Models\OnlineCall;
use Illuminate\Http\Request;

class OnlineCallController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $calls = OnlineCall::all();
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
    public function show($id)
    {
        $call = OnlineCall::findOrFail($id);
        return response (new OnlineCallResource($call));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'nullable|string|max:100',
            'age' => 'nullable|numeric',
            'problem' => 'nullable|string',
            'type' => 'nullable|string',
            'fees' => 'nullable|numeric',
            'doctor_id' => 'nullable|numeric',
            'status' => 'nullable|numeric',
        ]);

        $call = OnlineCall::findOrFail($id);

        $call->name = $request->name == null ? $call->name : $request->name;
        $call->age = $request->age == null ? $call->age : $request->age;
        $call->problem = $request->problem == null ? $call->problem : $request->problem;
        $call->type = $request->type == null ? $call->type : $request->type;
        $call->fees = $request->fees == null ? $call->fees : $request->fees;
        $call->doctor_id = $request->doctor_id == null ? $call->doctor_id : $request->doctor_id;
        $call->status = $request->status == null ? $call->status : $request->status;
        $call->prescription = $request->prescription == null ? $call->prescription : $request->prescription;

        $call->update();
        return response (new OnlineCallResource($call));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $call = OnlineCall::findOrFail($id);
        $call->delete();
        return response (['message' => 'Call deleted successful']);
    }
}
