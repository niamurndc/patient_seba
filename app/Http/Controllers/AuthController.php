<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * User registration.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function register(Request $request){
        $request->validate([
            'name' => 'required|string|max:100',
            'phone' => 'required|numeric|unique:users',
            'password' => 'required|string|min:6'
        ]);

        $user = new User();

        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->password = bcrypt($request->password);
        $user->token = rand(10000, 99999);
        $user->role = 0;
        $user->status = 0;

        $user->save();

        $token = $user->createToken('apptoken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response);
    }



    /**
     * User login.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function login(Request $request){
        $data = $request->validate([
            'phone' => 'numeric|required',
            'password' => 'string|required|min:6',
        ]);

        $user = User::where('phone', $data['phone'])->first();

        if(!$user || !Hash::check($data['password'], $user->password)){
            return response(['message' => 'Bad credentials']);
        }

        $token = $user->createToken('apptoken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response);
    }


    /**
     * Logout logged in user and token destroy.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function logout(Request $request){
        auth()->user()->tokens()->delete();
        return response(['message' => 'Your are logged out']);
    }
}
