<?php

namespace App\Http\Controllers;

use App\Http\Resources\ServiceAreaResource;
use App\Models\ServiceArea;
use Illuminate\Http\Request;

class ServiceAreaController extends Controller
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
        $areas = ServiceArea::all();
        return response (ServiceAreaResource::collection($areas));
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
            'title' => 'required|string|max:100',
            'image' => 'required|image|mimes:jpg,png,jpeg|max:1000',
            'doctor' => 'required|string',
            'nurse' => 'required|string',
            'medicine' => 'required|string',
            'status' => 'nullable|numeric',
        ]);

        $area = new ServiceArea();

        $area->title = $request->title;
        $area->doctor = $request->doctor;
        $area->nurse = $request->nurse;
        $area->medicine = $request->medicine;
        $area->status = $request->status == null ? 1 : $request->status;

        // add image
        $image = $request->file('image');
        $ext = $image->getClientOriginalExtension();
        $cover = 'area-'.time().'.'.$ext;
        $area->image = $cover;
        $path = 'uploads/area';
        $image->move($path, $cover);

        $area->save();
        return response (new ServiceAreaResource($area));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $area = ServiceArea::findOrFail($id);
        return response (new ServiceAreaResource($area));
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
            'title' => 'nullable|string|max:100',
            'image' => 'nullable|image|mimes:jpg,png,jpeg|max:1000',
            'doctor' => 'nullable|string',
            'nurse' => 'nullable|string',
            'medicine' => 'nullable|string',
            'status' => 'nullable|numeric',
        ]);

        $area = ServiceArea::findOrFail($id);

        $area->title = $request->title == null ? $area->title : $request->title;
        $area->doctor = $request->doctor == null ? $area->doctor : $request->doctor;
        $area->nurse = $request->nurse == null ? $area->nurse : $request->nurse;
        $area->medicine = $request->medicine == null ? $area->medicine : $request->medicine;
        $area->status = $request->status == null ? $area->status : $request->status;

        // add image
        $image = $request->file('image');
        if($image != null){
            $ext = $image->getClientOriginalExtension();
            $cover = 'area-'.time().'.'.$ext;
            $area->image = $cover;
            $path = 'uploads/area';
            $image->move($path, $cover);
        }

        $area->update();
        return response (new ServiceAreaResource($area));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $area = ServiceArea::findOrFail($id);
        $area->delete();
        return response (['message' => 'Area deleted successful']);
    }
}
