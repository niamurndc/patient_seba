<?php

namespace App\Http\Controllers;

use App\Http\Resources\SettingResource;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $setting = Setting::findOrFail($id);
        return response (new SettingResource($setting));
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
            'video_fee' => 'nullable|numeric',
            'audio_fee' => 'nullable|numeric',
            'chat_fee' => 'nullable|numeric',
            'shipping_cost' => 'nullable|numeric',
        ]);

        $setting = Setting::findOrFail($id);

        $setting->video_fee = $request->video_fee == null ? $setting->video_fee : $request->video_fee;
        $setting->audio_fee = $request->audio_fee == null ? $setting->audio_fee : $request->audio_fee;
        $setting->chat_fee = $request->chat_fee == null ? $setting->chat_fee : $request->chat_fee;
        $setting->shipping_cost = $request->shipping_cost == null ? $setting->shipping_cost : $request->shipping_cost;

        $setting->save();
        return response (new SettingResource($setting));
    }

}
