<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Details - MegaMart</title>
     @vite('resources/css/page.css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
</head>
<body>

    <x-header />
    <x-category-nav />

    <main class="page-container">
        <div class="product-details-container">
            <!-- Left: Product Image -->
            <div class="product-image-gallery">
                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product['name'] }}">
            </div>

            <!-- Right: Product Info -->

            <div class="product-info">
                <h1 class="product-name">{{ $product['name'] }}</h1>
                <p class="product-price">Rp {{ number_format($product['price'], 2) }}</p>
                <p class="product-stock">Stock: {{ $product['stock'] }}</p>
                <p class="product-description">{{ $product['description'] }}</p>

                <form action="{{ route('cart.add', $product['id']) }}" class="add-to-cart-form"> 
                <button type="submit" class="add-to-cart-button" 
                style="padding: 6px 16px; background-color: #007bff; color: #fff; border: none; border-radius: 4px; cursor: pointer; margin-right: 16px;"
                onclick="location.href='{{ route('cart.add', $product->id) }}'"
                    >
                        Add to Cart</button> 
                </form>
            </div>
        </div>
    </main>
</body>    
<x-footer/>
</html>