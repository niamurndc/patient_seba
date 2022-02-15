<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OfflineCallResource extends JsonResource
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
            'phone' => $this->phone,
            'problem' => $this->problem,
            'status' => $this->status,
            'type' => $this->type,
            'fees' => $this->fees,
            'address' => $this->address,
            'area' => $this->area == null ? 'No Area' : $this->area->title,
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
