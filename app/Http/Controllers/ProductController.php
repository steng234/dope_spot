<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function productSelection(Request $request)
    {
        $category = $request->query('category_id');
        $products = Product::where('category_id', $category)->get();
        // Here you can use the $category variable to filter or display relevant products
        // For example:
        // $products = Product::where('category', $category)->get();
        return view('product', compact('products'));
    }

    public function detail($id)
    {
        $product = Product::findOrFail($id); // Assuming you have the Product model
        
        return view('product-detail', compact('product'));
    }
}
