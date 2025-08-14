<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\storeController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;

Route::get('/', [storeController::class, 'index']) 
    ->name('store.index');
    

Route::get('/cart', [CartController::class, 'index'])
    ->name('cart.index');

Route::get('/product-details', [ProductController::class, 'show'])
    ->name('product.details');