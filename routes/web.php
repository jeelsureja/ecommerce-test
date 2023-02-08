<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Cart\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Product\ProductController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('layout.master');
// });


Route::get('/',[AuthController::class,'login'])->name('login');
Route::post('/verify-login',[AuthController::class,'verifyLogin'])->name('verify-login');
Route::get('/register',[AuthController::class,'register'])->name('register');
Route::post('/user-register',[AuthController::class,'userRegister'])->name('user-register');

Route::middleware('auth')->group(function (){
    Route::get('logout',[AuthController::class,'logout'])->name('logout');
    Route::get('home',[HomeController::class,'home'])->name('home');

    Route::prefix('product')->name('product-')->group(function () {
        Route::get('list',[ProductController::class,'index'])->name('list');
    });

    // Route::prefix('product')->name('product-')->group(function () {
        Route::get('cart',[CartController::class,'cart'])->name('cart');
        Route::get('add-to-cart/{id}',[CartController::class,'addToCart'])->name('add-to-cart');
        Route::patch('update-cart',[CartController::class,'update'])->name('update-cart');
        Route::delete('remove-from-cart',[CartController::class,'remove'])->name('remove-from-cart');

        Route::get('checkout',[CartController::class,'checkout'])->name('checkout');
        Route::post('place-order',[CartController::class,'placeOrder'])->name('place_order');
    // });
});