<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OnlineCallResource extends JsonResource
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
            'id' => $this->id,
            'name' => $this->name,
            'age' => $this->age,
            'problem' => $this->problem,
            'status' => $this->status,
            'type' => $this->type,
            'fees' => $this->fees,
            'channel' => $this->channel,
            'token' => $this->token,
            'prescription' => $this->prescription,
            'user' => $this->user == null ? 
                [
                    'name' => 'Not found', 
                    'phone' => 'N/A'
                ] : 
                [
                    'id' => $this->user->id, 
                    'name' => $this->user->name, 
                    'phone' => $this->user->phone
                ],
            'doctor' => $this->doctor == null ? 
                [
                    'name' => 'Not found', 
                    'phone' => 'N/A'
                ] : 
                [
                    'id' => $this->user->id, 
                    'name' => $this->user->name, 
                    'phone' => $this->user->phone,
                    'fees' => $this->user->fees,
                    'degree' => $this->user->degree,
                    'category' => $this->user->category,
                ],
            'created_at' => $this->created_at->diffForHumans(),
            'updated_at' => $this->updated_at->diffForHumans()
        ];
    }
}
