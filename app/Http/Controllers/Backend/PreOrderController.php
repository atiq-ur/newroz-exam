<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\CartItemRequest;
use App\Http\Requests\OrderPlaceRequest;
use App\Models\Cart;
use App\Repositories\OrderInterface;
use App\Repositories\PreOrderInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class PreOrderController extends Controller
{
    protected $preOrderInterface, $OrderInterface;
    public function __construct(PreOrderInterface $preOrderInterface, OrderInterface $OrderInterface){
        $this->preOrderInterface = $preOrderInterface;
        $this->OrderInterface = $OrderInterface;
    }

    public function index()
    {
        $preOrderProducts = $this->preOrderInterface->all();
        return view('backend.pages.preOrders.index',
            ['preOrderProducts' => $preOrderProducts]);
    }

    public function proDetails($name){
        list($product, $tastes) = $this->preOrderInterface->productDetails($name);
        return view('backend.pages.preOrders.product_details',
            ['product' => $product, 'tastes'=>$tastes]);
    }

    public function preOrderCart(CartItemRequest $request){
        //dd('test');
        list($product, $taste, $productData) = $this->preOrderInterface->addToCart($request->all());
        $cart = new Cart();
        $cart->isPreOrder = 1;
        $cart->product_id = $request->product_id;
        $cart->taste_id = $request->taste_id;
        $cart->product_data_id = $request->product_data_id;
        $cart->product_name = $product['data']['name'];
        $cart->taste = $taste['data']['taste'];
        $cart->weights = $productData['data']['weights'];
        $cart->quantity = $request->quantity;
        $cart->price = $productData['data']['price'];
        $cart->ip_address = $request->ip();
        $cart->save();
        toastr()->success('The product added to cart');
        return back();
    }

    public function preOrderCartView(){
        $carts = $this->OrderInterface->cartView();
        $isPreOrder = 1;
        return view('backend.pages.preOrders.cartView', ['carts' => $carts, 'isPreOrder', $isPreOrder]);
    }

}
