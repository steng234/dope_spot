<?php
 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\User;

class LoginController extends Controller
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
        return redirect('/home'); 
    }
}