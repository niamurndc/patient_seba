<?php

namespace App\Http\Controllers;

use App\Http\Resources\ServiceResource;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
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
        $services = Service::all();
        return response (ServiceResource::collection($services));
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
            'fees' => 'required|numeric',
            'type' => 'required|string',
            'area_id' => 'required|numeric',
        ]);

        $service = new Service();

        $service->title = $request->title;
        $service->fees = $request->fees;
        $service->type = $request->type;
        $service->area_id = $request->area_id;

        $service->save();
        return response (new ServiceResource($service));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $service = Service::findOrFail($id);
        return response (new ServiceResource($service));
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
            'fees' => 'nullable|numeric',
            'type' => 'nullable|string',
            'area_id' => 'nullable|numeric',
        ]);

        $service = Service::findOrFail($id);

        $service->title = $request->title == null ? $service->title : $request->title;
        $service->fees = $request->fees == null ? $service->fees : $request->fees;
        $service->type = $request->type == null ? $service->type : $request->type;
        $service->area_id = $request->area_id == null ? $service->area_id : $request->area_id;

        $service->update();
        return response (new ServiceResource($service));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $service = Service::findOrFail($id);
        $service->delete();
        return response (['message' => 'Service deleted successful']);
    }
}
