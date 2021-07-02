<?php
namespace App\Repositories;
use App\Helpers\APIHandler;
use App\Mail\InvoiceMail;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderProduct;
use Illuminate\Support\Facades\Mail;
use PDF;

class OrderRepository implements OrderInterface
{
    protected $order;
    public function __construct(){
        $this->order = new APIHandler();
    }
    public function all()
    {
        return $this->order->getAllProducts();
    }

    public function details($name): array
    {
        $products =  $this->order->getAllProducts();
        $product_id = 0;
        foreach ($products['data'] as $product) {
            if ($product['name'] == $name){
                $product_id = $product['id'];
            }
        }
        $product = $this->order->getSingleProduct($product_id);
        $tastes = $this->order->getProductTastesAll($product_id);
        //return ['product' => $product, 'tastes' => $tastes];
        return [$product, $tastes];
    }

    public function cart(array $data): array
    {
        $pro_id = $data['product_id'];
        $taste_id = $data['taste_id'];
        $product_data_id = $data['product_data_id'];

        $product = $this->order->getSingleProduct($pro_id);
        $taste = $this->order->getProductTasteSingle($pro_id, $taste_id);
        $productData = $this->order->getProductDataSingle($pro_id, $taste_id, $product_data_id);

        return [$product, $taste, $productData];
    }

    public function cartView()
    {
        return Cart::where('ip_address', request()->ip())->get();
    }

    public function place_order(array $data)
    {

        /*$order = new Order();
        $order->order_id = random_int(100000, 999999);
        $order->customer_name = $data['name'];
        $order->delivery_area = $data['delivery_area'];
        $order->customer_email = $data['email'];
        $order->customer_mobile_no = $data['mobile_number'];
        $order->customer_delivery_address =  $data['address'];
        $order->ip_address = request()->ip();
        $order->save()->$data->validated();*/
        $orderUniqueId = random_int(100000, 999999);
        $order = Order::create([
            'order_id' =>  $orderUniqueId,
            'customer_name' => $data['name'],
            'delivery_area' => $data['delivery_area'],
            'customer_email' => $data['email'],
            'customer_mobile_no' => $data['mobile_number'],
            'customer_delivery_address' => $data['address'],
            'ip_address' => \request()->ip(),
        ]);

        foreach ($this->cartView() as $cart){
            /*$order_product = new OrderProduct();
            $order_product->order_id = $order->id;
            $order_product->product_name = $cart->product_name;
            $order_product->taste_name = $cart->taste;
            $order_product->weights = $cart->weights;
            $order_product->quantity = $cart->quantity;
            $order_product->unit_price = $cart->price;
            $order_product->save()->$request->validated();*/
            OrderProduct::create([
                'order_id' => $order->id,
                'product_id' => $cart->product_id,
                'taste_id' => $cart->taste_id,
                'product_data_id' => $cart->product_data_id,
                'product_name' => $cart->product_name,
                'taste_name' => $cart->taste,
                'weights' => $cart->weights,
                'unit_price' => $cart->price,
                'quantity' => $cart->quantity,
            ]);

            // Update the stock
            $this->order->updateStock($cart->product_id, $cart->taste_id, $cart->product_data_id, $cart->quantity);

            $cart->delete();
        }
        $this->invoice();
    }
    public function invoice(){
        $order = Order::where('ip_address', \request()->ip())->first();
        $order_products = OrderProduct::where('order_id', $order->id)->get();
        PDF::loadView('backend.pages.orders.invoice', compact('order', 'order_products'))
            ->save(public_path('backend/orders/invoices/'.$order->order_id.'.pdf'));
        Mail::to($order->customer_email)->send(new InvoiceMail($order));
    }


    //Managing Orders
    public function orderLists()
    {
        return Order::orderBy('id', 'desc')->get();
    }

    public function orderView(Order $order)
    {
        $order = Order::findOrfail($order->id);
        return $order;
    }

    public function orderConfirm($order_id)
    {
        $order = Order::findOrFail($order_id);
        $order->order_status = 1;
        $order->update();
    }

    public function orderCancel($order_id)
    {
        $order = Order::findOrFail($order_id);
        $order->order_status = 2;

        $orderProducts = OrderProduct::where('order_id', $order->id)->get();
        foreach ($orderProducts as $orderProduct){
            $this->order->revertBackToStock
            ($orderProduct->product_id, $orderProduct->taste_id,
                $orderProduct->product_data_id,
                $orderProduct->quantity);
        }
        $order->update();
    }

    public function isDelivered($order_id)
    {
        $order = Order::findOrFail($order_id);
        $order->order_status = 4;
        $order->update();
    }
    public function destroyOrder($order_id)
    {
        $order = Order::findOrFail($order_id);
        $order->delete();
    }
}
