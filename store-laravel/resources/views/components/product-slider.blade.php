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
                <div class="product-image-container">
                    <img src="{{ $product->image }}" alt="{{ $product->name }}" class="product-image">
                </div>
                <div class="product-info">
                    <h3 class="product-name">{{ $product->name }}</h3>
                    <div class="product-pricing">
                        <span class="current-price">${{ number_format($product->price) }}</span>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</section>