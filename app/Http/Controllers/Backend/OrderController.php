<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\CartItemRequest;
use App\Http\Requests\OrderPlaceRequest;
use App\Mail\InvoiceMail;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Repositories\OrderInterface;
use Illuminate\Support\Facades\Mail;
use PDF;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    protected $OrderInterface;
    public function __construct(OrderInterface $OrderInterface){
        $this->OrderInterface = $OrderInterface;
    }

    public function index()
    {
        $products = $this->OrderInterface->all();
        return view('backend.pages.orders.index', ['products' => $products]);
    }

    public function details($name)
    {
        list($product, $tastes) = $this->OrderInterface->details($name);
        return view('backend.pages.orders.product_details',
            ['product' => $product, 'tastes'=>$tastes]);
    }

    public function cart(CartItemRequest $request){

        list($product, $taste, $productData) = $this->OrderInterface->cart($request->all());

        if ($productData['data']['quantity'] <= 0){
            toastr()->error('The product is stock out! please try another one');
            return back();
        }else if ($request->quantity > $productData['data']['quantity']){
            toastr()->error('The quantity should not greater than stock');
            return back();
        }else {
            $cart = new Cart();
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
    }

    public function cartView(){
        $carts = $this->OrderInterface->cartView();
        return view('backend.pages.orders.cartView', ['carts' => $carts]);
    }
    public function place_order(OrderPlaceRequest $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'mobile_number' => 'required',
            'address' => 'required',
        ]);
        $this->OrderInterface->place_order($request->all());
        toastr()->success('Wait for confirmation', 'Order placed');
        return view('backend.pages.orders.success');
    }

    // Managing Order
    public function orderLists(){
        $orderLists = $this->OrderInterface->orderLists();
        return view('backend.pages.manage_orders.order_lists', compact('orderLists'));
    }

    public function orderView(Order $order){
        $order = $this->OrderInterface->orderView($order);
        return view('backend.pages.manage_orders.order_view', ['order' => $order]);
    }
    public function orderConfirm($order_id){
        $this->OrderInterface->orderConfirm($order_id);
        toastr()->success('Order is Confirmed', 'Order Confirmation');
        return back();
    }
    public function orderCancel($order_id){
        $this->OrderInterface->orderCancel($order_id);
        toastr()->success('Order is Canceled', 'Order Cancellation');
        return back();
    }
    public function isDelivered($order_id){
        $this->OrderInterface->isDelivered($order_id);
        toastr()->success('Order is delivered', 'Order Delivered');
        return back();
    }
    public function destroyOrder($order_id){
        $this->OrderInterface->destroyOrder($order_id);
        toastr()->success('Order is deleted', 'Order Delete');
        return back();
    }

}
