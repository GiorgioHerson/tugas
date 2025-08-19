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
                                <img src="{{ $product->image }}" alt="{{ $product->name }}" class="product-image">
                            </div>
                            <div class="product-info">
                                <h3 class="product-name">{{ $product->name }}</h3>
                                <div class="product-pricing">
                                    <span class="current-price">₹{{ number_format($product->price) }}</span>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p class="no-products-found">No products found matching your criteria.</p>
                    @endforelse
                </div>
                {{ $products->links() }}
                </div>
            </section>
        </div>
    </main>

   
</body>
 <x-footer />
</html>