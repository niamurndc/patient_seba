<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Resources\DoctorResource;
use App\Models\User;

class DoctorListController extends Controller
{
    /**
     * Get logged in user profile.
     *
     * @return \Illuminate\Http\Response
     */

    public function index($cat){
        if($cat != 'all'){
            $doctors = User::where('role', 2)->where('category', $cat)->get();
        }else{
            $doctors = User::where('role', 2)->get();
        }

        $doctors = DoctorResource::collection($doctors);
        return response($doctors);
    }

}
