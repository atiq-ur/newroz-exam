<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductData extends Model
{
    use HasFactory;
    protected $fillable =
        [
            'taste_id',
            'weights',
            'price',
            'quantity',
        ];

    public function tastes(){
        return $this->belongsTo(Taste::class);
    }
}
