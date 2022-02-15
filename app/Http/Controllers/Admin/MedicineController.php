<?php

namespace App\Http\Controllers;

use App\Http\Resources\MedicineResource;
use App\Models\Medicine;
use Illuminate\Http\Request;

class MedicineController extends Controller
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
        $medicines = Medicine::all();
        return response (MedicineResource::collection($medicines));
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
            'genric' => 'required|string',
            'type' => 'required|string',
            'brand' => 'required|string',
            'price' => 'required|numeric',
            'unit' => 'required|string',
        ]);

        $medicine = new Medicine();

        $medicine->name = $request->name;
        $medicine->genric = $request->genric;
        $medicine->type = $request->type;
        $medicine->brand = $request->brand;
        $medicine->price = $request->price;
        $medicine->unit = $request->unit;

        $medicine->save();
        return response (new MedicineResource($medicine));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $medicine = Medicine::findOrFail($id);
        return response (new MedicineResource($medicine));
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
            'genric' => 'nullable|string',
            'type' => 'nullable|string',
            'brand' => 'nullable|string',
            'price' => 'nullable|numeric',
            'unit' => 'nullable|string',
        ]);

        $medicine = Medicine::findOrFail($id);

        $medicine->name = $request->name == null ? $medicine->name : $request->name;
        $medicine->genric = $request->genric == null ? $medicine->genric : $request->genric;
        $medicine->type = $request->type == null ? $medicine->type : $request->type;
        $medicine->brand = $request->brand == null ? $medicine->brand : $request->brand;
        $medicine->price = $request->price == null ? $medicine->price : $request->price;
        $medicine->unit = $request->unit == null ? $medicine->unit : $request->unit;

        $medicine->update();
        return response (new MedicineResource($medicine));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $medicine = Medicine::findOrFail($id);
        $medicine->delete();
        return response (['message' => 'Medicine deleted successful']);
    }
}
