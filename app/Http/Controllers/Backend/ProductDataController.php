<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductDataResource;
use App\Models\Product;
use App\Models\ProductData;
use App\Models\Taste;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductDataController extends Controller
{
    protected $client;

    public function __construct(){
        $this->client = new Client();
    }

    public function index($pro_id, $taste_id)
    {
        $product_res = $this->client->request('GET', 'http://127.0.0.1:8001/api/product/'.$pro_id);
        $product = json_decode($product_res->getBody()->getContents(), true);
        $taste_res = $this->client->request('GET', 'http://127.0.0.1:8001/api/product/'.$pro_id.'/tastes/'.$taste_id);
        $taste = json_decode($taste_res->getBody()->getContents(), true);

        $res = $this->client->request('GET', 'http://127.0.0.1:8001/api/product/'.$pro_id.'/tastes/'.$taste_id.'/utilities');
        $productData = json_decode($res->getBody()->getContents(), true);

        return view('backend.pages.products.product_data.index',
            ['product' => $product, 'productData' => $productData, 'taste'=> $taste]);
    }


    public function create()
    {
        //
    }


    public function store(Request $request, $pro_id, $taste_id)
    {

        $this->client->request('POST', 'http://127.0.0.1:8001/api/product/'.$pro_id.'/tastes/'.$taste_id.'/utilities',[
            'body' => json_encode($request->all()),
            'headers'=> [
                'content-type' => 'application/json',
            ]
        ]);
        toastr()->success('Product Data added', 'Data Uploaded');
        return back();
    }


    public function show(Product $product, Taste $taste, ProductData $productData)
    {
        if ($productData->taste_id != $taste->id){
            abort(404);
        }
        return (new ProductDataResource($productData->loadMissing(['tastes'])))->response();
    }


    public function edit($product_id, $taste_id, $productData_id)
    {
        $product_res = $this->client->request('GET', 'http://127.0.0.1:8001/api/product/'.$product_id);
        $product = json_decode($product_res->getBody()->getContents(), true);
        $taste_res = $this->client->request('GET', 'http://127.0.0.1:8001/api/product/'.$product_id.'/tastes/'.$taste_id);
        $taste = json_decode($taste_res->getBody()->getContents(), true);
        $res = $this->client->request('GET', 'http://127.0.0.1:8001/api/product/'.$product_id.'/tastes/'.$taste_id.'/utilities/'.$productData_id);
        $product_data = json_decode($res->getBody()->getContents(), true);
        return view('backend.pages.products.product_data.edit',
            ['product' => $product, 'taste'=> $taste, 'product_data' => $product_data]);
    }


    public function update(Request $request, $product_id, $taste_id, $productData_id)
    {
        //dd($productData_id);
        $this->client->request('PUT','http://127.0.0.1:8001/api/product/'.$product_id.'/tastes/'.$taste_id.'/utilities/'.$productData_id,[
            'body' => json_encode($request->all()),
            'headers'=> [
                'content-type' => 'application/json',
            ]
        ]);
        toastr()->success('Product Data updated', 'Data Updated');
        return back();
    }


    public function destroy($product_id, $taste_id,$productData_id)
    {
        $this->client->request('POST',
            'http://127.0.0.1:8001/api/product/'.$product_id.'/tastes/'.$taste_id.'/utilities/'.$productData_id,[
            'form_params' => [
                '_method' => 'DELETE'
            ]
        ]);
        toastr()->success('Product Data Deleted', 'Data Delete');
        return back();
    }
}
