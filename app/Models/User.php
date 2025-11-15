<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\Request;
use Laravel\Cashier\Billable;
class User extends Authenticatable implements MustVerifyEmail
{

    use Billable;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'users';
    protected $fillable = [
        'name',
        'email',
        'password',
        'google_id', 
        'telephone',
        'address',
        'city',
        'postal',
        'state'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Set the password attribute.
     *
     * @param string $password
     * @return void
     */
    public function setPasswordAttribute($password)
   {
        $this->attributes['password'] = Hash::make($password);
    }
    public function charge( $amount,  $paymentMethod,  $options = [])
   {
     

        // Create the user as a Stripe customer if they are not already
        if(!$this->stripe_id){
            $this->createAsStripeCustomer();
        }

        // Charge the user and return the invoice 
        return $this->invoiceFor($amount, $paymentMethod, $options);
    }
    public function saveData(Request $request)
   {
        try{
            // Create a new user instance
            $user = new User();
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->password = Hash::make($request->input('password')); // Hash the password
            $user->telephone = $request->input('telephone');
            $user->address = $request->input('address');
            $user->city = $request->input('city');
            $user->postal = $request->input('postal');
            $user->state = $request->input('state');
            // You can add other fields as needed
            
            $user->save(); // Save the user to the database

            return response()->json(['success' => true, 'message' => 'User registered successfully']);
        }catch(\Exception $e){
            return response()->json(['success' => false, 'message' => 'Error saving user: ' . $e->getMessage()], 500);
        }
    }
    public function cart()
   {
        return $this->hasOne(Cart::class);
    }
    public function creditCards()
{
    return $this->hasMany(CreditCard::class);
}
   
}
