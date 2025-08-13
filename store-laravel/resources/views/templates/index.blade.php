<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Ecommerce Store' }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <header class="bg-white shadow-sm mb-4">
        <nav class="navbar navbar-expand-lg navbar-light bg-white">
            <div class="container">
                <a class="navbar-brand fw-bold" href="/">{{ $title ?? 'Ecommerce Store' }}</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item"><a href="/" class="nav-link">Home</a></li>
                        <li class="nav-item"><a href="/products" class="nav-link">Products</a></li>
                        <li class="nav-item"><a href="/cart" class="nav-link">Cart</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <main class="container py-5">
        <div class="text-center mb-5">
            <h2 class="display-5 fw-semibold mb-2">{{ $title }}</h2>
            <p class="text-muted">{{$subtitle}}.</p>
        </div>
        <div class="row row-cols-1 row-cols-md-3 g-4">
            @if(isset($products) && count($products) > 0)
                @foreach ($products as $product)
                <div class="col">
                    <div class="card h-100 shadow-sm">
                        <img src="{{ asset($product['image']) }}" alt="{{ $product['name'] }}" class="card-img-top" style="object-fit:cover;height:200px;">
                        <div class="card-body d-flex flex-column align-items-center">
                            <h3 class="card-title h5 mb-2">{{ $product['name'] }}</h3>
                            <p class="card-text text-center mb-3">
                                {{ $product['description'] ?? 'Best product for you!' }}
                            </p>
                            <span class="fw-bold text-primary mb-3">${{ number_format($product['price'], 2) }}</span>
                            <a href="#" class="btn btn-success w-100">Add to Cart</a>
                        </div>
                    </div>
                </div>
                @endforeach
            @else
                <div class="col">
                    <div class="alert alert-warning text-center">No products available.</div>
                </div>
            @endif
        </div>
    </main>
    <footer class="bg-white mt-5 py-4 border-top">
        <div class="container text-center text-muted">
            &copy; {{ date('Y') }} Ecommerce Store. All rights reserved.
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
