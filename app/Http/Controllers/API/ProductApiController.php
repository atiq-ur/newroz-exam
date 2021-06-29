<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;


use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class ProductApiController extends BaseController
{

    public function index()
    {
        $products = Product::with('tastes.productData');
        //dd($products->tastes);
        //$productTastes = $products->tastes->with(['productData']);
        //return response()->json($products, 200);
        //return ProductResource::collection($products->paginate(5))->response();
        return $this->sendResponse(ProductResource::collection($products->paginate(25)), 'Data retrieved Successfully');
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

        ]);
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $product = Product::create($input);

        return $this->sendResponse(new ProductResource($product), 'Data uploaded successfully.');
    }


    public function show(Product $product)
    {
        return (new ProductResource($product->loadMissing(['tastes.productData'])))->response();
        //$contact = Contact::findOrFail($id);
        //return $this->sendResponse(new ContactResource($contact), 'Data got');
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        $input = $request->all();

        /*$validator = Validator::make($input, [
            'name' => 'required',
            'email' => 'required',
            'phone_number' => 'required',

        ]);
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }*/

        $product = Product::findOrFail($id);
        $product->name = $request->name;
        $product->update();
        return $this->sendResponse(new ProductResource($product), 'Data updated successfully.');
    }


    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        if ($product->delete()){
            return $this->sendResponse(new ProductResource($product), 'Data deleted');
        }
    }
}
