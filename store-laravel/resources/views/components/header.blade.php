{{-- resources/views/components/header.blade.php --}}

<header class="megamart-header">
    <div class="header-container">

        <!-- Left Section: Menu and Logo -->
        <div class="header-left">
            <!-- CSS-only Dropdown Toggle -->
            <div class="menu-container">
                <input type="checkbox" id="menu-checkbox" class="menu-checkbox">
                <label for="menu-checkbox" class="menu-icon-label" tabindex="0">
                    <i class="fas fa-bars"></i>
                </label>
                <!-- Simplified Dropdown Menu -->
                <nav class="dropdown-menu">
                    <a href="/" class="dropdown-menu-link">Home</a>
                    <a href="/catalog" class="dropdown-menu-link">Catalog</a>
                    <a href="/product-details" class="dropdown-menu-link">Product Details</a>
                    <a href="/cart" class="dropdown-menu-link">Cart</a>
                </nav>
            </div>
            <a href="/" class="logo">MegaMart</a>
        </div>

        <!-- Center Section: Search Bar -->
        <div class="header-center">
            <div class="search-bar">
                <i class="fas fa-search search-icon"></i>
                <input type="text" class="search-input" placeholder="Search essentials, groceries and more...">
                <button class="filter-icon" aria-label="Search options">
                    <i class="fas fa-sliders-h"></i>
                </button>
            </div>
        </div>

        <!-- Right Section: Auth and Cart -->
        <div class="header-right">
            <a href="/login" class="nav-link">
                <i class="far fa-user"></i>
                <span>Sign Up/Sign In</span>
            </a>
            <a href="/cart" class="nav-link">
                <i class="fas fa-shopping-cart"></i>
                <span>Cart</span>
                    </div>

    </div>
</header>