<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SettingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'video_fee' => $this->video_fee,
            'audio_fee' => $this->audio_fee,
            'chat_fee' => $this->chat_fee,
            'shipping_cost' => $this->shipping_cost,
        ];
    }
}
