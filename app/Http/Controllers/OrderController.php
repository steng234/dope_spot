<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;

class OrderController extends Controller
{
    public function showOrderSummary($orderId)
   {
        // Fetch order details from the database
         // Fetch order details from the database
    $order = Order::findOrFail($orderId);

    // Pass data to the view
    return view('orderSummary', compact('order'));
    }
}
