<?php
namespace App\Repositories;
use App\Http\Requests\OrderPlaceRequest;
use App\Models\Order;

interface OrderInterface {
    public function all();
    public function details($name);
    public function cart(array $data);
    public function cartView();
    public function place_order(array $data);
    public function invoice();
    public function orderLists();
    public function orderView(Order $order);
    public function orderConfirm($order_id);
    public function orderCancel($order_id);
    public function isDelivered($order_id);
    public function destroyOrder($order_id);

}
