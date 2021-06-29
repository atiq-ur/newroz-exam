<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $client;

    public function __construct(){
        $this->client = new Client();
    }


    public function index()
    {
        $client = new Client();
        $res = $client->request('GET', 'http://127.0.0.1:8001/api/product');
        $products =  json_decode($res->getBody()->getContents(), true);
        //dd($products);
        return view('backend.pages.products.index', ['products' => $products]);
    }



    public function store(Request $request)
    {

        $this->client->request('POST', 'http://127.0.0.1:8001/api/product',[
            'body' => json_encode($request->all()),
            'headers'=> [
                'content-type' => 'application/json',
            ]
        ]);
        toastr()->success('Data added', 'Uploaded');
        return back();
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $res = $this->client->request('GET', 'http://127.0.0.1:8001/api/product/'.$id);
        $product = json_decode($res->getBody()->getContents(), true);
        return view('backend.pages.products.edit', ['product' => $product]);
    }


    public function update(Request $request, $id)
    {
        $this->client->request('PUT', 'http://127.0.0.1:8001/api/product/'.$id,[
            'body' => json_encode($request->all()),
            'headers'=> [
                'content-type' => 'application/json',
            ]
        ]);
        toastr()->success('Data updated', 'Product Updated');
        return redirect()->route('products.index');
    }


    public function destroy($id)
    {
        $this->client->request('POST', 'http://127.0.0.1:8001/api/product/'.$id,[
            'form_params' => [
                '_method' => 'DELETE'
            ]
        ]);
        toastr()->success('Data Deleted', 'Product Delete');
        return redirect()->route('products.index');
    }
}
