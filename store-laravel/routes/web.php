<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\storeController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;

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

    Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
