<?php

namespace App\Http\Controllers;

use App\Http\Resources\MedicineOrderResource;
use App\Models\MedicineOrderItem;
use App\Models\MeidcineOrder;
use Illuminate\Http\Request;

class MedicineOrderOrderController extends Controller
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
        $medicines = MeidcineOrder::all();
        return response (MedicineOrderResource::collection($medicines));
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
            'phone' => 'required|numeric',
            'address' => 'required|string',
            'area_id' => 'required|numeric',
            'total' => 'required|numeric',
            'shipping_cost' => 'required|numeric',
            'payment' => 'required|string',
        ]);

        $medicine = new MeidcineOrder();

        $medicine->name = $request->name;
        $medicine->phone = $request->phone;
        $medicine->address = $request->address;
        $medicine->area_id = $request->area_id;
        $medicine->payment = $request->payment;
        $medicine->total = $request->total;
        $medicine->shipping_cost = $request->shipping_cost;
        $medicine->subtotal = $medicine->total + $medicine->shipping_cost;
        $medicine->user_id = auth()->user()->id;
        $medicine->status = 1;

        $medicine->save();

        foreach($request->carts as $request_cart){

            $cart = new MedicineOrderItem();

            $cart->order_id = $medicine->id;
            $cart->product_id = $request_cart['product_id'];
            $cart->price = $request_cart['price'];
            $cart->quantity = $request_cart['quantity'];

            $cart->save();
        }

        return response (new MedicineOrderResource($medicine));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $medicine = MeidcineOrder::findOrFail($id);
        return response (new MedicineOrderResource($medicine));
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
            'phone' => 'nullable|numeric',
            'address' => 'nullable|string',
            'area_id' => 'nullable|numeric',
            'total' => 'nullable|numeric',
            'shipping_cost' => 'nullable|numeric',
            'user_id' => 'nullable|numeric',
            'status' => 'nullable|numeric',
            'payment' => 'nullable|string',
        ]);

        $medicine = MeidcineOrder::findOrFail($id);

        $medicine->name = $request->name == null ? $medicine->name : $request->name;
        $medicine->phone = $request->phone == null ? $medicine->phone : $request->phone;
        $medicine->address = $request->address == null ? $medicine->address : $request->address;
        $medicine->status = $request->status == null ? $medicine->status : $request->status;
        $medicine->total = $request->total == null ? $medicine->total : $request->total;
        $medicine->shipping_cost = $request->shipping_cost == null ? $medicine->shipping_cost : $request->shipping_cost;
        $medicine->subtotal = ($request->total == null ? $medicine->total : $request->total) + ($request->shipping_cost == null ? $medicine->shipping_cost : $request->shipping_cost);
        $medicine->user_id = $request->user_id == null ? $medicine->user_id : $request->user_id;
        $medicine->area_id = $request->area_id == null ? $medicine->area_id : $request->area_id;
        $medicine->payment = $request->payment == null ? $medicine->payment : $request->payment;

        $medicine->update();
        return response (new MedicineOrderResource($medicine));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $medicine = MeidcineOrder::findOrFail($id);
        $medicine->delete();
        return response (['message' => 'MedicineOrder deleted successful']);
    }
}
