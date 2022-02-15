<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TransectionResource extends JsonResource
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
            'sender' => $this->sender == null ? ['id' => $this->sender_id, 'name' => 'Not Found'] : ['id' => $this->sender_id, 'name' => $this->sender->name],

            'reciver' => $this->reciver == null ? ['id' => $this->reciver_id, 'name' => 'Not Found'] : ['id' => $this->reciver_id, 'name' => $this->reciver->name],

            'method' => $this->method,
            'amount' => $this->amount,
            'trxid' => $this->trxid == null ? 'Not Found' : $this->trxid,
            'created_at' => $this->created_at->diffForHumans(),
            'updated_at' => $this->updated_at->diffForHumans()
        ];
    }
}
