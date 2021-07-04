<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Repositories\ProductInterface;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $productInterface;

    public function __construct( ProductInterface $productInterface){
        $this->productInterface = $productInterface;
    }


    public function index()
    {
        $products =  $this->productInterface->all();
        //dd($products);
        return view('backend.pages.products.index', ['products' => $products]);
    }



    public function store(Request $request)
    {
        $this->productInterface->store($request->all());
        toastr()->success('Product added', 'Uploaded');
        return back();
    }



    public function edit($id)
    {
        $product = $this->productInterface->show($id);
        return view('backend.pages.products.edit', ['product' => $product]);
    }


    public function update(Request $request, $id)
    {
       $this->productInterface->update($request->all(), $id);
        toastr()->success('Data updated', 'Product Updated');
        return redirect()->route('products.index');
    }


    public function destroy($id)
    {
        $this->productInterface->destroy($id);
        toastr()->success('Data Deleted', 'Product Delete');
        return redirect()->route('products.index');
    }
}
