<?php

namespace App\Http\Resources;
use App\Http\Resources\TasteResource;
use App\Http\Resources\ProductDataResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    //public $collects = Taste::class;
    public function toArray($request)
    {
        //$taste = $this->whenLoaded('taste');
        return [
            'id' => $this->id,
            'name' => $this->name,
            'updated_at' => $this->updated_at,
            'created_at' => $this->created_at,
            'tastes' => TasteResource::collection($this->whenLoaded('tastes')),
            //'tastes' => TasteResource::collection($this->whenLoaded('tastes')),
            //'product_data' => ProductData::collection($this->product_data),
        ];
    }
}
