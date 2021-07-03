<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable =
        [
            'order_id',
            'customer_name',
            'customer_email',
            'customer_mobile_no',
            'customer_delivery_address',
            'used_coupon',
            'delivery_area',
            'ip_address',
            'isPreOrder',
        ];
    public function orderedProducts(){
        return $this->hasMany(OrderProduct::class);
    }
}
