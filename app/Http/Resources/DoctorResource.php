<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DoctorResource extends JsonResource
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
            'phone' => $this->phone,
            'role' => $this->role,
            'status' => $this->status,
            'type' => $this->type,
            'category' => $this->category,
            'degree' => $this->degree,
            'balance' => $this->balance,
            'area' => $this->area_id == null ? ['title' => 'No Area'] : $this->area,
        ];
    }
}
