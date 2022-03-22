<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
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
            'id' =>$this->id,
            //attribute compact function call getNameAttribute(order Models)
            'name' => $this->name,
            'email' => $this->email,
            //getTotalAttribute() in model
            'total' => $this->total,
            'order_items' => OrderItemResource::collection($this->whenLoaded('orderItems'))
        ];
    }
}
