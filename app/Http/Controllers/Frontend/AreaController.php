<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Resources\ServiceAreaResource;
use App\Models\ServiceArea;

class AreaController extends Controller
{
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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function search()
    {
        $query = $_GET['search'];
        $areas = ServiceArea::where('title', $query)->get();
        return response (ServiceAreaResource::collection($areas));
    }
}
