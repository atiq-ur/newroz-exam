<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable =
        [
            'product_name',
            'taste',
            'weights',
            'quantity',
            'unit_price',
            'customer_name',
            'customer_email',
            'customer_mobile_no',
            'customer_delivery_address',
            'used_coupon',
        ];
}
