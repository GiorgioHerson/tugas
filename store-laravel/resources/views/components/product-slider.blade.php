{{-- resources/views/components/product-slider.blade.php --}}

@props(['products'])

<section class="product-slider-section">
    <header class="section-header">
        <h2 class="section-title">
            Grab the best deal on <span class="highlight">Electronics</span>
        </h2>
        <a href="/catalog?category=5" class="view-all-link">
            View All <i class="fas fa-chevron-right"></i>
        </a>
    </header>

    <div class="products-container">
        @foreach ($products as $product)
            <div class="product-card">
                <div class="product-image-container" style="img-fluid text-center; height: 200px; display: flex; align-items: center; justify-content: center; overflow: hidden;">
                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="product-image">
                </div>
                <div class="product-info" style="position: relative; min-height: 110px;">
                    <h3 class="product-name">{{ $product->name }}</h3> 
                    <span class="px-4 py-2 border" style="display: block; margin-bottom: 40px;">
                        Rp {{ number_format($product->price, 0, ',', '.') }}
                    </span>
                    <div style="position: absolute; bottom: 10px; display: flex; justify-content: space-between;">
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
                            Details
                        </button>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</section>