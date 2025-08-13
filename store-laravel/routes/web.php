<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\storeController;
use App\Http\Controllers\CartController;

Route::get('/', [storeController::class, 'index']) 
    ->name('store.index');
    

Route::get('/products', [storeController::class, 'index'])
    ->name('store.products');

Route::get('/cart', [CartController::class, 'index'])
    ->name('cart.index');
