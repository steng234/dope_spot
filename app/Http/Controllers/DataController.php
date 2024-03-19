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

class DataController extends Controller
{
/**
     * Handle an authentication attempt.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function authenticate(Request $request): RedirectResponse
    {
        
        $user = User::where('email',$request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            $request->session()->put('user_name',  $user->name);
            $request->session()->put('user_email',  $user->email);
            $request->session()->put('user_id',  $user->id);
             return redirect('/home'); 
        } else {
            return redirect()->back();
        }
      
    }

    public function logout(): RedirectResponse
    {
        Auth::logout(); // Logout the user
        Session::forget('user_name'); // Clear the user's name from session
        Session::forget('user_email');
        Session::forget('id');
        return redirect('/home'); 
    }

    public function register(Request $request): RedirectResponse
    {
       
        // Validate the incoming request data
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        
        // Create a new user record
        $user = User::create([
            'name' => $request->name,
            'surname' => $request->surname,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

         // Create a new cart for the user
            $cart = new Cart();
            $cart->user_id = $user->id; // Associate the cart with the newly created user
            $cart->save();
     

        // Redirect the user after successful registration
        return redirect()->route('login')->with('success', 'Registration successful! Please log in.');
    }
    public function updateProfile(Request $request ): RedirectResponse
    {
        Log::info('Request data:', $request->all());
        
        try {    

            $userData = [
                'name' => $request->filled('name') ? $request->name : null,
                'address' => $request->filled('address') ? $request->address : null,
                'postal' => $request->filled('postal') ? $request->postal : null,
                'city' => $request->filled('city') ? $request->city : null,
                'state' => $request->filled('state') ? $request->state : null,
                'telephone' => $request->filled('telephone') ? $request->telephone : null
            ];
    
            $affectedRows = DB::table('users')
                ->where('email', Session::get('user_email'))
                ->update(array_filter($userData, function ($value) {
                    return $value !== null; // Filter out null values
                }));

            if ($affectedRows > 0) {
                $request->session()->put('user_name', $request->input('name'));
                $request->session()->put('user_email', Session::get('user_email'));
                return redirect()->back()->with('success', 'Profile data updated successfully!');
            } else {
                return response()->json(['error' => 'No user found to update'], 404);
            }

            // Optionally update session data
            
        } catch (Exception $e) {
            dd();
            // Handle user not found scenario (e.g., return an error message)
            return Redirect::back()->with('error', 'User not found!');
        }
        
        
    }
    public function updatePassword(Request $request ): RedirectResponse
    {
        try{
        
            
        // Validate the incoming request data
        $request->validate([
            'old' => ['required', 'string'],
            'new' => ['required', 'string', 'min:8'],
        ]);


        // Retrieve the user from the database
        $user = User::where('email', Session::get('user_email'))->first();
        // Check if the old password matches the user's current password
        if (!Hash::check($request->old, $user->password)) {
            Log::info('Requesfadfadjsnflksdaflksdflsdterjihuwejb');
            return redirect()->back()->with('error', 'The old password is incorrect');
            }
        Log::info('Request data:', $request->all());
        // Update the user's password in the database
        
        $user->password = bcrypt($request->new);

        $user->save();

        return redirect()->back()->with('success', 'Password updated successfully!');
        } catch (Exception $e) {
            dd();
            // Handle user not found scenario (e.g., return an error message)
            return Redirect::back()->with('error', 'User not found!');
        }
        
        
    }

    public function fetchUserId(Request $request)
    {
        return response()->json([
            'userId' => $request->session()->get('user_id')
        ]);
    }
    
}
