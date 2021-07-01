<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\CartItemRequest;
use App\Mail\InvoiceMail;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderProduct;
use Illuminate\Support\Facades\Mail;
use PDF;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class OrderController extends Controller
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
        return view('backend.pages.orders.index', ['products' => $products]);
    }
    public function details($name)
    {
        $client = new Client();
        $res = $client->request('GET', 'http://127.0.0.1:8001/api/product');
        $products =  json_decode($res->getBody()->getContents(), true);
        //dd($products);
        $product_id = 0;
        foreach ($products['data'] as $product) {
            if ($product['name'] == $name){
                $product_id = $product['id'];
            }
        }
        $product_res = $this->client->request('GET', 'http://127.0.0.1:8001/api/product/'.$product_id);
        $product = json_decode($product_res->getBody()->getContents(), true);
        $taste_res = $this->client->request('GET', 'http://127.0.0.1:8001/api/product/'.$product_id.'/tastes');
        $tastes = json_decode($taste_res->getBody()->getContents(), true);
        return view('backend.pages.orders.product_details',
            ['product' => $product, 'tastes'=>$tastes]);
    }
    public function cart(CartItemRequest $request){
        $pro_id = $request->product_id;
        $taste_id = $request->taste_id;
        $product_data_id = $request->product_data_id;
        $product_res = $this->client->request('GET', 'http://127.0.0.1:8001/api/product/'.$pro_id);
        $product = json_decode($product_res->getBody()->getContents(), true);

        $taste_res = $this->client->request('GET', 'http://127.0.0.1:8001/api/product/'.$pro_id.'/tastes/'.$taste_id);
        $taste = json_decode($taste_res->getBody()->getContents(), true);

        $res = $this->client->request('GET', 'http://127.0.0.1:8001/api/product/'.$pro_id.'/tastes/'.$taste_id.'/utilities/'.$product_data_id);
        $productData = json_decode($res->getBody()->getContents(), true);
        //dd($productData['data']['id']);


        if ($productData['data']['quantity'] <= 0){
            toastr()->error('The product is stock out! please try another one');
            return back();
        }else if ($request->quantity > $productData['data']['quantity']){
            toastr()->error('The quantity should not greater than stock');
            return back();
        }else {
            //Cart::create($request->validated());
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
            //dd($request->product_id);
            toastr()->success('The product added to cart');
            return back();
        }


        /*return view('backend.pages.products.product_data.index',
            ['product' => $product, 'productData' => $productData, 'taste'=> $taste]);*/
    }
    public function cartView(){
        $carts = Cart::where('ip_address', request()->ip())->get();
        return view('backend.pages.orders.cartView', ['carts' => $carts]);
    }
    public function place_order(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'mobile_number' => 'required',
            'address' => 'required',
        ]);
        $carts = Cart::where('ip_address', request()->ip())->get();
        $orderId = random_int(100000, 999999);
        $order = new Order();
        $order->order_id = $orderId;
        $order->customer_name = $request->name;
        $order->delivery_area = $request->delivery_area;
        $order->customer_email = $request->email;
        $order->customer_mobile_no = $request->mobile_number;
        $order->customer_delivery_address = $request->address;
        $order->ip_address = $request->ip();
        $order->save();

        foreach ($carts as $cart){
            $order_product = new OrderProduct();
            $order_product->order_id = $order->id;
            $order_product->product_name = $cart->product_name;
            $order_product->taste_name = $cart->taste;
            $order_product->weights = $cart->weights;
            $order_product->quantity = $cart->quantity;
            $order_product->unit_price = $cart->price;
            $order_product->save();

            /* Update the stock*/
            $this->client->request('GET',
                'http://127.0.0.1:8001/api/product/'.$cart->product_id.'
                /tastes/'.$cart->taste_id.'/utilities/'.$cart->product_data_id.'/updateStock/'.$cart->quantity);
            /*End Update the stock*/
            $cart->delete();
        }
        $this->invoice();
        toastr()->success('Wait for confirmation', 'Order placed');
        return view('backend.pages.orders.success');

    }
    public function invoice(){
        $order = Order::where('ip_address', request()->ip())->first();
        //dd($order->delivery_area);
        $order_products = OrderProduct::where('order_id', $order->id)->get();
        $pdf = PDF::loadView('backend.pages.orders.invoice', compact('order', 'order_products'))
            ->save(public_path('backend/orders/invoices/'.$order->order_id.'.pdf'));
        Mail::to($order->customer_email)->send(new InvoiceMail($order));
        //return $pdf->download($order->order_id.'.pdf');
        //return $pdf->stream($order->order_id.'.pdf');
        //return true;
        //return view('backend.pages.orders.invoice', compact('order', 'order_products'));
    }
}
