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
                    'totalPieces' => $totalPieces
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
        Log::info($request);
        $request->validate([
            'variationId' => 'required|exists:product_variations,id',
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

                    // Check if the product variation already exists in the cart
                if ($cart->products()->where('product_variation_id', $variationId)->exists()) {
                    // If the product variation exists, update its quantity
                    $cart->products()->updateExistingPivot($variationId, [
                        'quantity' => DB::raw('quantity + 1')
                    ]);
                } else {
                    // If the product variation doesn't exist, add it to the cart with quantity 1
                    $cart->products()->attach($variationId, ['quantity' => 1]);
                    $cart->save();
                }

                // Return a JSON response indicating success
                return response()->json(['message' => 'Quantity updated successfully'], 200);
            }
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

}
