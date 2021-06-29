<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Taste extends Model
{
    use HasFactory;
    protected $fillable =
        [
            'product_id',
            'taste'
        ];

    public function productData(){
        return $this->hasMany(ProductData::class);
    }
    public function products(){
        return $this->belongsTo(Product::class);
    }
}
