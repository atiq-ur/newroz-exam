<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Http\Resources\TasteResource;
use App\Models\Product;
use App\Models\Taste;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Validator;

class TasteApiController extends BaseController
{

    public function index($id)
    {
        $product = Product::findOrFail($id);
        $tastes = Taste::where('product_id', $product->id);
        //$tastes = Taste::with('products');
        //dd($product);
        return $this->sendResponse(TasteResource::collection($tastes->paginate(5)), 'Taste Data retrieved Successfully');

    }

    public function create()
    {
        //
    }


    public function store(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $input = $request->all();
        $input['product_id'] = $id;

        $validator = Validator::make($input, [
            'product_id' => 'required',
            'taste' => 'required',

        ]);
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $taste = Taste::create($input);

        return $this->sendResponse(new TasteResource($taste), 'Taste Data uploaded successfully.');
    }


    public function show(Product $product, Taste $taste)
    {
        if ($taste->product_id != $product->id){
            abort(404);
        }

        return (new TasteResource($taste->loadMissing(['products'])))->response();

    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, Product $product, Taste $taste)
    {
        if ($taste->product_id != $product->id){
            abort(404);
        }
        //$taste =  (new TasteResource($taste->loadMissing(['products'])))->response();
       // dd($taste['data']);
        $input = $request->all();
        $input['product_id'] = $product->id;

        $validator = Validator::make($input, [
           'product_id' => 'required',
            'taste' => 'required',

        ]);
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $taste = Taste::findOrFail($taste->id);
        //$taste->taste = $request->taste;
        $taste->update($input);
        return $this->sendResponse(new TasteResource($taste), 'Taste Data updated successfully.');

    }


    public function destroy(Product $product, Taste $taste)
    {
        if ($taste->product_id != $product->id){
            abort(404);
        }
        //$taste = Taste::findOrFail($id);
        if ($taste->delete()){
            return $this->sendResponse(new TasteResource($taste), 'Taste Data deleted');
        }
    }
}
