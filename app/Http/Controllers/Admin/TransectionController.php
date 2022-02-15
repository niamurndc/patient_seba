<?php

namespace App\Http\Controllers;

use App\Http\Resources\TransectionResource;
use App\Models\Transection;
use Illuminate\Http\Request;

class TransectionController extends Controller
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
        $transections = Transection::all();
        return response (TransectionResource::collection($transections));
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
            'sender_id' => 'required|numeric',
            'reciver_id' => 'required|numeric',
            'amount' => 'required|numeric',
            'method' => 'required|string',
            'trxid' => 'nullable|string',
        ]);

        $transection = new Transection();

        $transection->sender_id = $request->sender_id;
        $transection->reciver_id = $request->reciver_id;
        $transection->amount = $request->amount;
        $transection->method = $request->method;
        $transection->trxid = $request->trxid;

        $transection->save();
        return response (new TransectionResource($transection));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $transection = Transection::findOrFail($id);
        return response (new TransectionResource($transection));
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
            'sender_id' => 'nullable|numeric',
            'reciver_id' => 'nullable|numeric',
            'amount' => 'nullable|numeric',
            'method' => 'nullable|string',
            'trxid' => 'nullable|string',
        ]);

        $transection = Transection::findOrFail($id);

        $transection->sender_id = $request->sender_id == null ? $transection->sender_id : $request->sender_id;
        $transection->reciver_id = $request->reciver_id == null ? $transection->reciver_id : $request->reciver_id;
        $transection->amount = $request->amount == null ? $transection->amount : $request->amount;
        $transection->method = $request->method == null ? $transection->method : $request->method;
        $transection->trxid = $request->trxid == null ? $transection->trxid : $request->trxid;

        $transection->update();
        return response (new TransectionResource($transection));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $transection = Transection::findOrFail($id);
        $transection->delete();
        return response (['message' => 'Transection deleted successful']);
    }
}
