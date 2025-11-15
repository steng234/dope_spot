<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Http\Controllers\DataController;
use App\Http\Controllers\GoogleLoginController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CreditCardController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function(){
    return view('welcome');
});
Route::get('/login', function(){
    return view('login');
});
Route::get('/register', function(){
    return view('register');
});
Route::get('/home', function(){
    return view('welcome');
});
Route::get('/about', function(){
    return view('about');
});;
Route::get('/profile', function(){
    return view('profile');
});;



Route::view('/', 'welcome')->name('home');
Route::view('/login', 'login')->name('login');
Route::view('/register', 'register')->name('register');
Route::view('/about', 'about')->name('about');
Route::view('/shipping', 'shipping')->name('shipping');
Route::view('/addPayment', 'addPayment')->name('payment.add');

Route::post('/login', [DataController::class, 'authenticate'])->name('login.post');
Route::post('/register', [DataController::class, 'register'])->name('register.post');
Route::post('/update-profile', [DataController::class, 'updateProfile'])->name('profile.update');
Route::post('/update-password', [DataController::class, 'updatePassword'])->name('password.update');
Route::post('/cart/add', [CartController::class, 'addToCart']);
Route::post('/cart/updateQuantity', [CartController::class, 'updateQuantity'])->name('cart.updateQuantity');
Route::post('/cart/remove', [CartController::class, 'removeFromCart'])->name('cart.removeFromCart');
Route::post('/addPayment', [CreditCardController::class, 'addPayment'])->name('addPayment');
Route::post('/checkout', [CartController::class, 'checkout'])->name('checkout');
Route::post('/shopNow', [CartController::class, 'checkout'])->name('shopNow');

Route::get('/search-items', [ProductController::class, 'search'])->name('search.items');
Route::get('/profile', [DataController::class, 'userProfile'])->name('profile');
Route::get('/logout', [DataController::class, 'logout'])->name('logout');
Route::get('/logout', [DataController::class, 'logout'])->name('logout');
Route::get('/product', [ProductController::class, 'productSelection'])->name('productSelection');
Route::get('/api/user-id', [DataController::class, 'fetchUserId']);
Route::get('/product/{id}', [ProductController::class, 'detail'])->name('product-detail');
Route::get('/cart', [CartController::class, 'countCartProduct'])->name('cart');
Route::get('/order-summary/{OrderId}', [OrderController::class, 'showOrderSummary'])->name('order.summary');
Route::get('/payment', [CreditCardController::class, 'index'])->name('payment');
Route::get('/login/google', [GoogleLoginController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('/login/google/callback', [GoogleLoginController::class, 'handleGoogleCallback'])->name('auth.google.callback');

