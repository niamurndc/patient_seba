<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class UserProfileController extends Controller
{
    /**
     * Get logged in user profile.
     *
     * @return \Illuminate\Http\Response
     */

    public function profile(){
        $user = new UserResource(auth()->user());
        return response($user);
    }

    /**
     * Update logged in user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request){
        $id = auth()->user()->id;
        $user = User::findOrFail($id);

        $user->name = $request->name;
        $user->password = $request->password == null ? $user->password : bcrypt($request->password);

        $user->update();
        $user = new UserResource($user);
        return response($user);
    }
}
