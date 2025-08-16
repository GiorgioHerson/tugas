<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class storeController extends Controller
{
    public function index()
    {
{
    $electronics = Product::where('product_category_id', '5')
                          ->latest()
                          ->take(5)
                          ->get();

    return view('home', ['products' => $electronics]);
}
    }
}