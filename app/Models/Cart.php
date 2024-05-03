<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $table = 'Cart';
    protected $fillable = [
        'user_id',
    ];
    
    /**
     * Get the user that owns the cart.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the products in the cart.
     */
    public function products()
    {
        return $this->belongsToMany(ProductVariation::class, 'cart_products')
        ->withPivot('quantity', 'product_variation_id')
        ->with('product.category', 'product.brand', 'product.images','product.type');     
    }
    
    public function calculateTotal()
    {
        $total = 0;

        foreach ($this->products as $product) {
            $total += $product->price * $product->pivot->quantity;
        }

        return $total;
    }

    public function calculateQuantity()
    {
        $quantity = 0;

        foreach ($this->products as $product) {
            $quantity += $product->pivot->quantity;
        }

        return $quantity;
    }


}
