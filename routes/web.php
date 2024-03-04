<?php

use Illuminate\Support\Facades\Route;
use app\Http\Controllers\Auth\LoginRegisterController;
use app\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\GoogleLoginController;
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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/login', function () {
    return view('login');
});
Route::get('/register', function () {
    return view('register');
});
Route::get('/home', function () {
    return view('welcome');
});
Route::get('/about', function () {
    return view('about');
});;
Route::get('/profile', function () {
    return view('profile');
});;


Route::post('/logn', 'App\Http\Controllers\LoginController@authenticate');

Route::post('/vRegister', [RegisterController::class, 'register'])->name('register');

Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/login/google', [GoogleLoginController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('/login/google/callback', [GoogleLoginController::class, 'handleGoogleCallback']);