<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class TasteResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    //public $collects = ProductData::class;
    public function toArray($request)
    {
        //$tasted = $this->whenLoaded('taste');
        return [
            'id' => $this->id,
            'product_id' => $this->product_id,
            'taste' => $this->taste,
            'updated_at' => $this->updated_at,
            'created_at' => $this->created_at,
            //'tasted' => new TasteResource($tasted),
            'productData' => ProductDataResource::collection($this->whenLoaded('productData')),
        ];
    }
}
