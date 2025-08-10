<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
    /* return view('welcome') */;
});


Route::get('/products', function () {
    return "products details";

});

Route::get('/cart', function () {
    return "cart details";

});

Route::get('/checkout', function () {
    return "checkout details";

});