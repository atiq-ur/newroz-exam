<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    use HasFactory;
    protected $fillable =
        [
            'name',
            'minimum_order_quantity',
            'start_time',
            'end_time',
            'fixed_amount',
            'percentage',
            'isActive',
        ];
}
