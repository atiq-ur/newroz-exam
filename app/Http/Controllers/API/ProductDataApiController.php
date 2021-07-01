<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Backend\TasteController;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductDataResource;
use App\Http\Resources\TasteResource;
use App\Models\Product;
use App\Models\ProductData;
use App\Models\Taste;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Validator;

class ProductDataApiController extends BaseController
{

    public function index(Product $product, Taste $taste)
    {
        //$product = Product::findOrFail($product->id);
        if (!$product){
            abort('404');
        }

        //$taste = Taste::where('product_id', $product->id);
        if (!$taste){
            abort('404');
        }
        $utilities = ProductData::where('taste_id', $taste->id);
        //dd($product);
        return $this->sendResponse(ProductDataResource::collection($utilities->paginate(15)), 'Product Data retrieved Successfully');

    }

    public function create()
    {
        //
    }


    public function store(Request $request, Product $product, Taste $taste)
    {
        //$product = Product::findOrFail($product->id);

        $input = $request->all();
        $input['taste_id'] = $taste->id;

        $validator = Validator::make($input, [
            'taste_id' => 'required',
            'weights' => 'required',
            'price' => 'required',
            'quantity' => 'required',
        ]);
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }
        $productData = ProductData::create($input);

        return $this->sendResponse(new ProductDataResource($productData), 'Product Price,weights,Quantity uploaded successfully.');

    }


    public function show(Product $product, Taste $taste, $id)
    {
        $productData = ProductData::findOrFail($id);

        if ($productData->taste_id != $taste->id){
            abort(404);
        }
        return (new ProductDataResource($productData->loadMissing(['tastes'])))->response();
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, Product $product, Taste $taste, $id)
    {
        $input = $request->all();
        $product_data= ProductData::findOrFail($id);
        if ($product_data->taste_id != $taste->id){
            abort(404);
        }
        $input['taste_id'] = $product_data->id;

        $validator = Validator::make($input, [
            'taste_id' => 'required',
            'weights' => 'required',
            'price' => 'required',
            'quantity' => 'required',
        ]);
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }
        $product_data->update($input);
        return $this->sendResponse(new ProductDataResource($product_data), 'Product Data updated successfully.');
    }


    public function destroy(Product $product, Taste $taste, $productData_id)
    {
        /*if ($taste->product_id != $product->id){
            abort(404);
        }*/
        $productData = ProductData::findOrFail($productData_id);
        //return $productData->id;
        if ($productData->delete()){
            return $this->sendResponse(new ProductDataResource($productData), 'Product Data deleted');
        }
    }

    public function product_info(Product $product, Taste $taste, $productData_id, $weights ){
        $productData = ProductData::find($productData_id);
        //return $weights;

        if ($taste->id != $productData->taste_id){
            abort(404);
        }
        $QueryInfo = ProductData::where('weights', $weights)->first();
        return $this->sendResponse(new ProductDataResource($QueryInfo), 'Product Data Query Success');
    }

    public function updateStock(Product $product, Taste $taste, $productData_id, $qty ){

       //return $qty;
        $product_data= ProductData::findOrFail($productData_id);
        if ($product_data->taste_id != $taste->id){
            abort(404);
        }
        if ($taste->product_id != $product->id){
            abort(404);
        }

        $updateQty = $product_data->quantity - $qty;
        $product_data->quantity = $updateQty;
        $product_data->update();
        return $this->sendResponse(new ProductDataResource($product_data), 'Stock was updated');
    }
}
