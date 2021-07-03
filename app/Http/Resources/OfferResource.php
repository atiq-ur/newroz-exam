<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OfferResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'minimum_order_quantity' => $this->minimum_order_quantity,
            'fixed_amount' => $this->fixed_amount,
            'percentage' => $this->percentage,
            'start_time' => $this->start_time,
            'end_time' => $this->end_time,
            'isActive' => $this->isActive,
            'updated_at' => $this->updated_at,
            'created_at' => $this->created_at,

        ];
    }
}
