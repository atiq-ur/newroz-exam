<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $fillable =
        [
            'product_name',
            'taste',
            'weights',
            'quantity',
            'price',
            'ip_address'
        ];

    public static function totalCartItems(){
        $carts = Cart::where('ip_address', request()->ip())->get();
        return count($carts);
    }
}
