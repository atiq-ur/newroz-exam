<?php

namespace App\Models;

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
        ];

    public function order(){
        return $this->hasMany(Order::class);
    }
}
