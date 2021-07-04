<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\OfferResource;
use App\Models\Offer;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Validator;

class OfferApiController extends BaseController
{

    public function index()
    {
        $offers = Offer::all();
        return $this->sendResponse(OfferResource::collection($offers), 'Offer Data retrieved Successfully');

    }

    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'name' => 'required',
            'minimum_order_quantity' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',

        ]);
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }
        //return $request->all();

       $offer = Offer::create($input);

        return $this->sendResponse(new OfferResource($offer), 'Added a new Offer successfully.');

    }

    public function show($id)
    {
        $offer = Offer::findOrFail($id);
        //return 1;
        return $this->sendResponse(new OfferResource($offer), 'Data retrieved Successfully');
        //return $this->sendResponse( OfferResource::collection($offer), 'Offer Data retrieved Successfully');

    }


    public function edit($id)
    {
        //
    }

    public function update(Request $request, Offer $offer)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'name' => 'required',
            'minimum_order_quantity' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
        ]);
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }
        $offer->update($input);
        return $this->sendResponse(new OfferResource($offer), 'Product Data updated successfully.');

    }

    public function destroy(Offer $offer)
    {
        $offer->delete();
        return $this->sendResponse(new OfferResource($offer), 'Offer deleted Successfully.');
    }

    public function isOffer(){
        $offer = Offer::where('isActive', 1)->first();
        if (!$offer){
            return $this->sendError('Currently we have no offer');
        }else{
            return $this->sendResponse(new OfferResource($offer), 'Data retrieved Successfully');
        }

    }

    public function updateStatus(Offer $offer){
        if ($offer->isActive){
            $offer->isActive = 0;
        }else{
            $existsOffer = Offer::where('isActive', 1)->first();
            if ($existsOffer){
                return $this->sendError('Already a offer Activated. First de-active it', 500);
            }else{
                $offer->isActive = 1;
            }
        }
        $offer->update();
        //return 1;
        return $this->sendResponse(new OfferResource($offer), 'Offer Status Updated Successfully.');
    }
}
