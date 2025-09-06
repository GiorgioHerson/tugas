<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catalog - MegaMart</title>
     @vite('resources/css/page.css')

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
<x-header />
</head>  
<body>


<main class="page-container">
<div class="catalog-layout">
<!-- Filter Sidebar -->
<aside class="filter-sidebar">
    <h3 class="filter-title">Filters</h3>
    <form action ="{{ route('catalog.index') }}" method="GET" class="filter-form">
        <div class="filter-form-row">
            <div class="filter-group">
                <label for="search">Search</label>
                <input type="text" name="search" id="search" placeholder="Product" value="{{ request('search') }}">
            </div>

            <div class="filter-group">
                <label for="category">Category</label>
                <select name="category" id="category">
                    <option value="">All Categories</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="filter-group price-range-group">
                <label>Price Range</label>
                <div class="price-inputs">
                    <input type="number" name="min_price" placeholder="Min" value="{{ request('min_price') }}">
                    <input type="number" name="max_price" placeholder="Max" value="{{ request('max_price') }}">
                </div>
            </div>

            <div class="filter-group">
                <label>&nbsp;</label> 
                <button type="submit" class="btn btn-primary">Apply</button>
            </div>
        </div>
        <a href="{{ url('/catalog') }}" class="clear-filters-link">Clear Filters</a>
    </form>
</aside>
<!-- Product Grid -->
<section class="product-grid-container">
    <div class="product-grid">
        @forelse ($products as $product)
            <div class="product-card">
                <div class="product-image-container">
                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="product-image">
                </div>
                <div class="product-info">
                    <h3 class="product-name">{{ $product->name }}</h3>
                    <div class="product-pricing">
                        <span class="current-price">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                    </div>
                    <div class="product-actions">
                        <div style="display: flex; justify-content: space-between; gap: 10px;">
                            </button>
                    <button 
                            class="add-to-cart-button" 
                            style="padding: 6px 16px; background-color: #007bff; color: #fff; border: none; border-radius: 4px; cursor: pointer; margin-right: 16px;"
                            onclick="location.href='{{ route('cart.add', $product->id) }}'"
                        >
                            Add to Cart
                        </button>
                        <button 
                class="product-details-button" 
                style="padding: 6px 16px; background-color: #f8f9fa; color: #333; border: 1px solid #ddd; border-radius: 4px; cursor: pointer; margin-left: 20px;"
                onclick="location.href='{{ route('product.details', $product->id) }}'"
            >
               Product Details
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <p class="no-products-found">No products found matching your criteria.</p>
        @endforelse
    </div>
    {{ $products->links() }}
</section>
</div>
</main>


</body>
 <x-footer />
</html>