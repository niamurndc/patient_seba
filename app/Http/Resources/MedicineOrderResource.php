<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MedicineOrderResource extends JsonResource
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
            'address' => $this->address,
            'status' => $this->status,
            'total' => $this->total,
            'shipping_cost' => $this->shipping_cost,
            'subtotal' => $this->subtotal,
            'payment_method' => $this->payment,
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
            'created_at' => $this->created_at->diffForHumans(),
            'updated_at' => $this->updated_at->diffForHumans()
        ];
    }
}
