<?php

namespace App\Http\Controllers;

use App\Models\ProductCategory;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = ProductCategory::paginate(8);
         $productStock = Product::sum('stock');
         $productPrices = Product::sum('price');

     $totalStockValue = Product::all()->sum(function ($product) {
        return $product->price * $product->stock;
     });

    return view('admin.product-categories.index', compact('categories',
     'productStock', 'productPrices', 'totalStockValue'));
}
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:product_categories,name',
        ]);

        $category = new ProductCategory;
        $category->name = $request->name;
        $category ->save();

        return redirect()->back()->with('success', 'Category created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(ProductCategory $productCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProductCategory $productCategory)
    {
        return view('admin.product-categories.edit', compact('productCategory'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProductCategory $productCategory)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $productCategory->update($validated);

        return redirect()->route('admin.product-categories.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProductCategory $productCategory)
    {
        if ($productCategory) {
            $productCategory->delete();
            return redirect()->route('admin.product-categories.index');
        }
    }
}
