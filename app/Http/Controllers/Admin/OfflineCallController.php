<?php

namespace App\Http\Controllers;

use App\Http\Resources\OfflineCallResource;
use App\Models\OfflineCall;
use Illuminate\Http\Request;

class OfflineCallController extends Controller
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
        $calls = OfflineCall::all();
        return response (OfflineCallResource::collection($calls));
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $call = OfflineCall::findOrFail($id);
        return response (new OfflineCallResource($call));
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
            'phone' => 'nullable|numeric',
            'problem' => 'nullable|string',
            'address' => 'nullable|string',
            'type' => 'nullable|string',
            'fees' => 'nullable|numeric',
            'doctor_id' => 'nullable|numeric',
            'status' => 'nullable|numeric',
            'area_id' => 'nullable|numeric',
        ]);

        $call = OfflineCall::findOrFail($id);

        $call->name = $request->name == null ? $call->name : $request->name;
        $call->age = $request->age == null ? $call->age : $request->age;
        $call->phone = $request->phone == null ? $call->phone : $request->phone;
        $call->problem = $request->problem == null ? $call->problem : $request->problem;
        $call->address = $request->address == null ? $call->address : $request->address;
        $call->type = $request->type == null ? $call->type : $request->type;
        $call->fees = $request->fees == null ? $call->fees : $request->fees;
        $call->doctor_id = $request->doctor_id == null ? $call->doctor_id : $request->doctor_id;
        $call->status = $request->status == null ? $call->status : $request->status;
        $call->area_id = $request->area_id == null ? $call->area_id : $request->area_id;

        $call->update();
        return response (new OfflineCallResource($call));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $call = OfflineCall::findOrFail($id);
        $call->delete();
        return response (['message' => 'Call deleted successful']);
    }
}
