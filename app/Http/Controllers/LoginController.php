<?php
 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
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
            

             return redirect('/home'); 
        
        } else {
            return redirect()->back();
        }
       
 
      
    }
}