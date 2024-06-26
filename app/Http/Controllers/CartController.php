<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Exception;
use App\Models\Product;


class CartController extends Controller
{   
    public function countCartProduct()
    {
        // Retrieve the authenticated user
        $user = User::where('email', Session::get('user_email'))->first();

        // Check if the user is authenticated
        if ($user) {
            $cart = $user->cart;

            // Check if the user has a cart
            if ($cart) {
                // Retrieve the cart items count
                // Retrieve the cart items and calculate total price and total pieces
                $cartItems = $cart->products;
                $totalPrice = 0;
                $totalPieces = 0;
                foreach ($cartItems as $item) {
                    $totalPrice += $item->pivot->quantity * $item->price; // Assuming 'price' is the attribute name for the price of the product
                    $totalPieces += $item->pivot->quantity;
                }

                // Pass the cart items count, total price, and total pieces to the view
                return view('cart', [
                    'cartItems' => $cartItems,
                    'cartItemCount' => $cartItems->count(),
                    'totalPrice' => $totalPrice,
                    'totalPieces' => $totalPieces,
                    'cartId'=> $cart->id
                ]);
            } else {
                // If the user does not have a cart, create one
                $cart = new Cart();
                $user->cart()->save($cart);
            // Pass the cart items count to the view
            return view('cart', ['cartItemCount' => 0]);
        }
        } else {
            // Handle the acase when the user is not authenticated
            // Redirect or display an error message
        }
    }
      

    
    public function addToCart(Request $request)
    {
        
        $request->validate([
            'variationId' => 'required|exists:product_variations,id',
        ]);
     
        // Retrieve the authenticated user
        $userId = session('user_id'); // Replace 'user_id' with the key you used to store the ID in the session

        // Find the user by ID
        $user = User::find($userId);

        if (!$user) {
            return redirect()->route('login');
        }
        // Check if the user is authenticated
        if ($user) {
            
            // Retrieve the cart associated with the user
            $cart = $user->cart;
        
            // Check if the user has a cart
            if (!$cart) {
                // If the user doesn't have a cart, create a new one
                $cart = new Cart();
                $user->cart->save($cart);
            }
        
            // Retrieve the variation ID from the request
            $variationId = $request->input('variationId');
        
            // Check if the product variation already exists in the cart
            if ($cart->products()->where('product_variation_id', $variationId)->exists()) {
                // If the product variation exists, update its quantity
                $cart->products()->updateExistingPivot($variationId, [
                    'quantity' => DB::raw('quantity + 1')
                ]);
            } else {
                // If the product variation doesn't exist, add it to the cart with quantity 1
                $cart->products()->attach($variationId, ['quantity' => 1]);
            }
        
            // Return a JSON response indicating success
            return response()->json(['message' => 'Quantity updated successfully'], 200);
        }

        // Return a JSON response indicating failure
        return response()->json(['message' => 'Failed to update quantity'], 400);
    }


    public function updateQuantity(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'variationId' => 'required|exists:product_variations,id',
            'quantity' => 'required|integer|min:1',
        ]);

        // Retrieve the authenticated user
        $user = Auth::user();

        // Check if the user is authenticated
        if ($user) {
            // Retrieve the cart associated with the user
            $cart = $user->cart;

            // Check if the user has a cart
            if ($cart) {
                // Retrieve the variation ID and quantity from the request
                $variationId = $request->input('variationId');
                $quantity = $request->input('quantity');

                // Update the quantity of the product variation in the cart
                $cart->products()->updateExistingPivot($variationId, ['quantity' => $quantity]);

                // Return a JSON response indicating success
                return response()->json(['message' => 'Quantity updated successfully'], 200);
            }
        }

        // Return a JSON response indicating failure
        return response()->json(['message' => 'Failed to update quantity'], 400);
    }

    public function removeFromCart(Request $request)
    {
    
        // Validate the incoming request data
        $request->validate([
            'variationId' => 'required|exists:product_variations,id',
        ]);

        // Retrieve the authenticated user
        $user = Auth::user();

        // Check if the user is authenticated
        if ($user) {
            // Retrieve the cart associated with the user
            $cart = $user->cart->firstOrCreate([]);
            // Check if the user has a cart
            if ($cart) {
                // Retrieve the variation ID from the request
                $variationId = $request->input('variationId');

                // Detach the product variation from the cart
                $cart->products()->detach($variationId);

                // Return a JSON response indicating success
                return response()->json(['message' => 'Product removed from cart successfully'], 200);
            }
        }

        // Return a JSON response indicating failure
        return response()->json(['message' => 'Failed to remove product from cart'], 400);
    }

    public function checkout(Request $request)
    {
        // Retrieve the payment method id from the request
        $paymentMethodId = $request->input('payment_method_id');

        // Step 1: Retrieve the user ID from the session
        $userId = Session::get('user_id');

        // Step 2: Use the user ID to find the corresponding user
        $user = User::findOrFail($userId);
    
        // Step 3: Retrieve the cart associated with the user
        $cart = $user->cart;
    
        // Ensure the cart exists before proceeding
        if (!$cart) {
            return redirect()->back()->with('error', 'Cart not found.');
        }
        // Create a new order
        $order = new Order();
        $order->user_id = auth()->id();
        $order->credit_card_id = $paymentMethodId; // Assuming you're storing the authenticated user's id
        $order->total = $cart->calculateTotal(); // Calculate the total price of the order
        $order->quantity = $cart->calculateQuantity(); // Calculate the total quantity of items
        $order->status = 'pending'; // Set the initial status of the order
        $order->save();
        $cart->products()->detach();
        // Loop through the cart items and create order items for each product
        foreach ($cart->products as $product) {
            $orderItem = new OrderItem();
            $orderItem->order_id = $order->id;
            $orderItem->product_variations_id = $product->pivot->product_variation_id;
            $orderItem->quantity = $product->pivot->quantity;
            $orderItem->price = $product->price; // You may need to adjust this depending on your logic
            $orderItem->save();
        }

        // After saving the order and order items, you may want to clear the cart
        // $cart->products()->detach(); // Detach all products from the cart

        // Redirect to the order summary page
        return redirect()->route('order.summary', ['OrderId' => $order->id]);

    }

    public function checkoutWithoutCart(Request $request)
    {

        // Retrieve the payment method id from the request
        $variation = $request->input('variationId');

        Session::put('variationId', $variation);
        $userId= Session::get('user_id');

        // Step 2: Use the user ID to find the corresponding user
        $user = User::findOrFail($userId);
    

        if (!$user) {
            return redirect()->route('login');
        }

        // Create a new order
     /*  
        return redirect()->route('order.summary', ['OrderId' => $order->id]);
        */

    }

}
