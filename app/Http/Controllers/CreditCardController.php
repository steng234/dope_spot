<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CreditCard;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;

class CreditCardController extends Controller
{

    public function index()
    {
        $user = auth()->user();
        $paymentMethods = $user->creditCards;
        return view('payment', compact('paymentMethods'));
    }
    public function addPayment(Request $request)
    {
        try {
            // Log the received request data
            Log::info('Received request data:', $request->all());
    
            // Create a new credit card instance
            $creditCard = new CreditCard();
            $creditCard->user_id = auth()->user()->id;
            $creditCard->card_number = $request->input('cardNumber');
            $creditCard->expiry_date = $request->input('expiryDate');
            $creditCard->cvv = $request->input('cvv');
            
            // Log the credit card data before saving
            Log::info('Credit card data:', $creditCard->toArray());
    
            // Save the credit card to the database
            $creditCard->save();
            Log::info('Saved');
    
            // Log a success message
            Log::info('Payment method added successfully');
    
            return  redirect('/cart');
        } catch (\Exception $e) {
            // Log any exceptions that occur
            Log::error('Error adding payment method:', ['message' => $e->getMessage(), 'trace' => $e->getTrace()]);
            return response()->json(['success' => false, 'message' => 'Error adding payment method'], 500);
        }
    }

}

