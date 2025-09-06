<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductCategory;

class AdminProductController extends Controller
{
     public function index(Request $request)
    {
        $query = Product::query();
        $categories = ProductCategory::all();
       
        if ($categoryId = $request->get ('category')) {
            $query->where('product_category_id', $categoryId);
        }
        
        if ($search = $request->get('search')) {
            $query->where('name', 'like', "%{$search}%")
            ->orWhere('description', 'like', "%{$search}%")
            ->orWhereHas('category', function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%");
            });
            
        }

        try {
            $products = $query->paginate(10); 
           
            return view('admin.products.index', compact('products' , 'categories'));
        } catch (\Exception $e) {
            return back()->with('error', 'Error loading products: ' . $e->getMessage());
        }
    }    

public function create()
    {
        $categories = ProductCategory::all();
      return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:products,name',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:1',
            'category_id' => 'required|exists:product_categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $validated['product_category_id'] = $validated['category_id'];
        unset($validated['category_id']);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('products', 'public');
        }

        Product::create($validated);

        return redirect()->route('admin.products.index')->with('success', 'Product "' . $validated['name'] . '" created successfully!');
    }

    public function destroy(Product $product)
    {
        if ($product) {
            $product->delete();
            return redirect()->route('admin.products.index' )->with('success', 'Product " ' . $product->name . ' " deleted successfully!' );
        }
    }

    public function edit(Product $product)
    {
        $categories = ProductCategory::all();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function editProduct($id)
    {
        $product = Product::findOrFail($id);
        $categories = ProductCategory::all();
        return view('admin.products.edit', compact('product', 'categories'));
    }
    public function update(Request $request, Product $product)
        
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category_id' => 'required|exists:product_categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp,img|max:2048'
        ]);  

        $validated['product_category_id'] = $validated['category_id'];
        unset($validated['category_id']);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('products', 'public');
        }

        $product->update($validated);

        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully!');

    }
}