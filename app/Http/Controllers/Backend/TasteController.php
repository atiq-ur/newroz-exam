<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class TasteController extends Controller
{
    protected $client;

    public function __construct(){
        $this->client = new Client();
    }

    public function index($id)
    {
        $res = $this->client->request('GET', 'http://127.0.0.1:8001/api/product/'.$id);
        $product = json_decode($res->getBody()->getContents(), true);
        return view('backend.pages.products.tastes.index', ['product' => $product]);
    }


    public function create()
    {
        //
    }


    public function store(Request $request, $id)
    {
        //$res = $this->client->request('GET', 'http://127.0.0.1:8001/api/product/'.$id);
        //$product = json_decode($res->getBody()->getContents(), true);
        $this->client->request('POST', 'http://127.0.0.1:8001/api/product/'.$id.'/tastes',[
            'body' => json_encode($request->all()),
            'headers'=> [
                'content-type' => 'application/json',
            ]
        ]);
        toastr()->success('Test Data added', 'Test Data Uploaded');
        return back();
    }


    public function show($id)
    {
        //
    }


    public function edit($product_id, $taste_id)
    {
        $res = $this->client->request('GET', 'http://127.0.0.1:8001/api/product/'.$product_id.'/tastes/'.$taste_id);
        $taste = json_decode($res->getBody()->getContents(), true);
        return view('backend.pages.products.tastes.edit', ['taste' => $taste]);
    }


    public function update(Request $request, $product_id, $taste_id)
    {
        $this->client->request('PUT', 'http://127.0.0.1:8001/api/product/'.$product_id.'/tastes/'.$taste_id,[
            'body' => json_encode($request->all()),
            'headers'=> [
                'content-type' => 'application/json',
            ]
        ]);
        toastr()->success('Data updated', 'Taste Updated');
        /*$res = $this->client->request('GET', 'http://127.0.0.1:8001/api/product/'.$product_id);
        $product = json_decode($res->getBody()->getContents(), true);
        return redirect()->route('products.tastes.index', $product);*/
        return back();
    }


    public function destroy($product_id, $taste_id)
    {
        $this->client->request('POST', 'http://127.0.0.1:8001/api/product/'.$product_id.'/tastes/'.$taste_id,[
            'form_params' => [
                '_method' => 'DELETE'
            ]
        ]);
        toastr()->success('Data Deleted', 'Taste Delete');
        //return redirect()->route('products.index');
        return back();
    }
}
