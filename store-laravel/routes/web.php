<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\storeController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductCategoryController;

Route::get('/', [storeController::class, 'index'])

    ->name('store.index');

 Route::get('/products', [storeController::class, 'index'])

    ->name('store.products');

 Route::get('/cart', [CartController::class, 'index'])

    ->name('cart.index');

Route::get('/product-details', [ProductController::class, 'show'])

    ->name('product.details');

    Route::get('/catalog', [ProductController::class, 'index'])

    ->name('catalog.index');
