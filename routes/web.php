<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderItemController;
use App\Http\Controllers\ReviewController;

Route::get('/', function () {
    return redirect('/products');
});

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {

    Route::resource('products', ProductController::class);

    Route::resource('categories', CategoryController::class);

    Route::resource('cart', CartController::class);

    Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
    Route::post('/wishlist', [WishlistController::class, 'store'])->name('wishlist.store');
    Route::get('/wishlist/{id}', [WishlistController::class, 'show'])->name('wishlist.show');
    Route::delete('/wishlist/{id}', [WishlistController::class, 'destroy'])->name('wishlist.destroy');

    Route::resource('orders', OrderController::class);

    Route::get('/order-items', [OrderItemController::class, 'index'])->name('order-items.index');
    Route::get('/order-items/{id}', [OrderItemController::class, 'show'])->name('order-items.show');

    Route::resource('reviews', ReviewController::class);
});