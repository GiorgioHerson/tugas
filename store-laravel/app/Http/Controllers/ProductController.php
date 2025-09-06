<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\ProductCategory;

class ProductController extends Controller
{

    public function index(Request $request)
    {
        $query = Product::query();

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('category')) {
            $query->where('product_category_id', $request->category);
        }

        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }

        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        $products = $query->paginate(9);
        
        $categories = ProductCategory::all();

        return view('catalog', [
            'products' => $products,
            'categories' => $categories
        ]);
    }

    public function show($id)
    {
        $product = Product::with('category')->findOrFail($id);

        $sessionKey = 'product_clicked_' . $id;
        if (!session()->has($sessionKey)) {
            $product->increment('clicks');
            session()->put($sessionKey, true);
        }

        return view('product-details', compact('product'));
    }
}