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
                <img src="{{ $product['image'] }}" alt="{{ $product['name'] }}">
            </div>

            <!-- Right: Product Info -->
            <div class="product-info-details">
                <h1 class="pdp-product-name">{{ $product['name'] }}</h1>
                <p class="pdp-description">{{ $product['description'] }}</p>
                
                <div class="pdp-pricing">
                    <span class="pdp-current-price">₹{{ number_format($product['current_price']) }}</span>
                    <span class="pdp-original-price">₹{{ number_format($product['original_price']) }}</span>
                    <span class="pdp-discount">{{ round(100 - ($product['current_price'] / $product['original_price'] * 100)) }}% OFF</span>
                </div>

                <div class="pdp-actions">
                    <div class="quantity-selector">
                        <label for="quantity">Quantity:</label>
                        <input type="number" id="quantity" value="1" min="1">
                    </div>
                    <button class="btn btn-primary">Add to Cart</button>
                    <button class="btn btn-secondary">Buy Now</button>
                </div>
                
                <div class="delivery-info">
                    <i class="fas fa-truck"></i>
                    <span>Delivery by Tomorrow, 9 PM</span>
                </div>
            </div>
        </div>
    </main>

</body>
<x-footer />
</html>