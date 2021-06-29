<?php

namespace App\Http\Resources;
use App\Http\Resources\TasteResource;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductDataResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $product = $this->whenLoaded('products');
        $taste = $this->whenLoaded('tastes');
        return [
            'id' => $this->id,
            //'taste_id' => $this->taste_id,
            'weights' => $this->weights,
            'price' => $this->price,
            'quantity' => $this->quantity,
            'updated_at' => $this->updated_at,
            'created_at' => $this->created_at,
            'tastes' => new TasteResource($taste),
            'products' => new ProductResource($product),
        ];
    }
}
