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
                $cartItemCount = $cart->products()->count();
                $cartItems = $cart->products;

                // Pass the cart items count to the view
                return view('cart', ['cartItemCount' => $cartItemCount,'cartItems' => $cartItems]);
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
}
