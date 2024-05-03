<?php
// app/Models/OrderItem.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'product_variations_id',
        'quantity',
        'price',
    ];

    public function order()
    {
        return  $this->belongsTo(Order::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function productVariation()
{
    return $this->belongsTo(ProductVariation::class, 'product_variations_id');
}
}
