<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\storeController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AdminProductController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductCategoryController;
use App\Models\Product;

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

    
Route::middleware('auth')->group(function () {
Route::middleware('admin')->group(function () {
        Route::get('/dashboard', [DashboardController::class ,'index'])->name('dashboard');
        Route::prefix('admin')->name('admin.')->group(function () {
        Route::resource('products', AdminProductController::class);
            Route::resource('product-categories',ProductCategoryController::class);
    });
       Route::get('/dashboard', [DashboardController::class ,'index'])->name('dashboard');
});

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
