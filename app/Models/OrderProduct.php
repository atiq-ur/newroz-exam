<?php

namespace App\Models;

use App\Helpers\APIHandler;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    use HasFactory;
    protected $fillable  =
        [
            'order_id',
            'product_id',
            'taste_id',
            'product_data_id',
            'product_name',
            'taste_name',
            'weights',
            'quantity',
            'unit_price',
            'ip_address',
        ];

    public function order(){
        return $this->hasMany(Order::class);
    }
    public static function getCurrentProductTastes($id){
        $prev_ordered_product = OrderProduct::where('ip_address', request()->ip())
            ->where('product_id', $id)
            ->first();
        if (!$prev_ordered_product){
            return null;
        }else {
            $response = new APIHandler();
            return $response->getProductTastesAll($id);
        }
    }

    public static function getProductData($product_id, $taste_id){
        $response = new APIHandler();
        return $response->getProductDataAll($product_id, $taste_id);
    }
}
