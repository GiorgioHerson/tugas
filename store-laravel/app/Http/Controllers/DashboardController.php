<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProducts = Product::count();
        $productStock = Product::sum('stock');
        $productPrices = Product::sum('price');
        $totalCategories =ProductCategory::count();
        $totalClicks = Product::sum('clicks');

        $totalStockValue = Product::all()->sum(function ($product) {
            return $product->price * $product->stock;
        });
    
        return view('dashboard', compact(
        'totalProducts',
        'totalCategories',
        'totalClicks',
        'productStock',
        'productPrices',
        'totalStockValue'));
    }
}
