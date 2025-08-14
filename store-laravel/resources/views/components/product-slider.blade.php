<div>
{{-- resources/views/components/product-slider.blade.php --}}

<section class="product-slider-section">
    <!-- Section Header -->
    <header class="section-header">
        <h2 class="section-title">
            Grab the best deal on <span class="highlight">Smartphones</span>
        </h2>
        <a href="/smartphones" class="view-all-link">
            View All <i class="fas fa-chevron-right"></i>
        </a>
    </header>

    <!-- Products Container -->
    <div class="products-container">

        <!-- Product Card 1 -->
        <div class="product-card">
            <div class="product-image-container">
                <img src="{{ asset('images/galaxy S22 Ultra.jpg') }}" alt="Galaxy S22 Ultra" class="product-image">
                <div class="discount-badge">56% OFF</div>
            </div>
            <div class="product-info">
                <h3 class="product-name">Galaxy S22 Ultra</h3>
                <div class="product-pricing">
                    <span class="current-price">₹32999</span>
                    <span class="original-price">₹74999</span>
                </div>
                <div class="product-savings">
                    Save - ₹32999
                </div>
                <button class="add-to-cart-btn">
                    <i class="fas fa-shopping-cart"></i>
                    Add to Cart
                </button>
            </div>
        </div>

        <!-- Product Card 2 (Highlighted) -->
        <div class="product-card highlighted">
            <div class="product-image-container">
                <img src="{{ asset('images/Galaxy M13.jpg') }}" alt="Galaxy M13" class="product-image">
                <div class="discount-badge">56% OFF</div>
            </div>
            <div class="product-info">
                <h3 class="product-name">Galaxy M13 (4GB | 64 GB)</h3>
                <div class="product-pricing">
                    <span class="current-price">₹10499</span>
                    <span class="original-price">₹14999</span>
                </div>
                <div class="product-savings">
                    Save - ₹4500
                </div>
                <button class="add-to-cart-btn">
                    <i class="fas fa-shopping-cart"></i>
                    Add to Cart
                </button>
            </div>
        </div>

        <!-- Product Card 3 -->
        <div class="product-card">
            <div class="product-image-container">
                <img src="{{ asset('images/Galaxy M33.png') }}" alt="Galaxy M33" class="product-image">
                <div class="discount-badge">56% OFF</div>
            </div>
            <div class="product-info">
                <h3 class="product-name">Galaxy M33 (4GB | 64 GB)</h3>
                <div class="product-pricing">
                    <span class="current-price">₹16999</span>
                    <span class="original-price">₹24999</span>
                </div>
                <div class="product-savings">
                    Save - ₹8000
                </div>
                <button class="add-to-cart-btn">
                    <i class="fas fa-shopping-cart"></i>
                    Add to Cart
                </button>
            </div>
        </div>
        
        <!-- Product Card 4 -->
        <div class="product-card">
            <div class="product-image-container">
                <img src="{{ asset('images/Galaxy M53.jpg') }}" alt="Galaxy M53" class="product-image">
                <div class="discount-badge">56% OFF</div>
            </div>
            <div class="product-info">
                <h3 class="product-name">Galaxy M53 (4GB | 64 GB)</h3>
                <div class="product-pricing">
                    <span class="current-price">₹31999</span>
                    <span class="original-price">₹40999</span>
                </div>
                <div class="product-savings">
                    Save - ₹9000
                </div>
                <button class="add-to-cart-btn">
                    <i class="fas fa-shopping-cart"></i>
                    Add to Cart
                </button>
            </div>
        </div>

        <!-- Product Card 5 -->
        <div class="product-card">
            <div class="product-image-container">
                <img src="{{ asset('images/Galaxy.png') }}" alt="Galaxy S22 Ultra" class="product-image">
                <div class="discount-badge">56% OFF</div>
            </div>
            <div class="product-info">
                <h3 class="product-name">Galaxy S22 Ultra</h3>
                <div class="product-pricing">
                    <span class="current-price">₹67999</span>
                    <span class="original-price">₹85999</span>
                </div>
                <div class="product-savings">
                    Save - ₹18000
                </div>
                <button class="add-to-cart-btn">
                    <i class="fas fa-shopping-cart"></i>
                    Add to Cart
                </button>
            </div>
        </div>

    </div>
</section>
</div>