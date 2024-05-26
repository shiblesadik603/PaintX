<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StripeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [LoginController::class, 'login'])->name('login');
Route::post('/', [LoginController::class, 'loginPost'])->name('login.post');
Route::get('/register', [LoginController::class, 'register'])->name('register');
Route::post('/register', [LoginController::class, 'registerPost'])->name('register.post');



Route::group(['middleware' => 'auth'], function () {
    //user panel
    Route::get('/home', [UserController::class, 'index'])->name('user.dashboard');
    Route::get('/product/{id}', [ProductController::class, 'prooduct_detail'])->name('product.details');

    //admin panel
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::match(['get', 'post'], '/items/search', [ItemController::class, 'search'])->name('items.search');
    Route::get('/items/create', [ItemController::class, 'create'])->name('items.create');
    Route::post('/items', [ItemController::class, 'store'])->name('items.store');
    Route::get('/items/{id}/edit', [ItemController::class, 'edit'])->name('items.edit');
    Route::put('/items/{id}', [ItemController::class, 'update'])->name('items.update');
    Route::delete('/items/{id}', [ItemController::class, 'destroy'])->name('items.destroy');


    //all routes for stripe
    Route::post('/session', [StripeController::class, 'session'])->name('session');
    Route::get('/success', [StripeController::class, 'success'])->name('success');
    Route::get('/cancel', [StripeController::class, 'cancel'])->name('cancel');
      
    //all routes for cart
    Route::get('/cart', [CartController::class, 'cart'])->name('cart');
    Route::get('/add-to-cart/{id}', [CartController::class, 'addToCart'])->name('add_to_cart');
    Route::patch('/update-cart', [CartController::class, 'update'])->name('update_cart');
    Route::delete('/remove-from-cart', [CartController::class, 'remove'])->name('remove_from_cart');


    //profile section
    Route::get('/profile', [ProfileController::class, 'index'])->name('users.profile');
    Route::post('/profile', [ProfileController::class, 'updateProfile'])->name('profiles.update');

    Route::get('/item/{id}', 'ItemController@show')->name('item.show');

    Route::get('/review/{id}', [ItemController::class, 'review'])->name('review');
    Route::post('/review/{id}', [ItemController::class, 'submit_review'])->name('submit_review');

});

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
