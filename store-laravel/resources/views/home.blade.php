<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Home | Ecommerce</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container py-5">
    <div class="row mb-4">
        <div class="col text-center">
            <h1 class="display-4 fw-bold">Welcome to Our Store</h1>
            <p class="lead">Find the best products at the best prices!</p>
        </div>
    </div>
    <div class="row mb-5">
        <div class="col-md-8 mx-auto">
            <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                </div>
                <div class="carousel-inner rounded-4 shadow">
                    <div class="carousel-item active">
                        <img src="https://source.unsplash.com/800x300/?ecommerce,store" class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="https://source.unsplash.com/800x300/?shopping,products" class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="https://source.unsplash.com/800x300/?sale,discount" class="d-block w-100" alt="...">
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </div>
    <h2 class="mb-4 text-center">Featured Products</h2>
    <div class="row row-cols-1 row-cols-md-3 g-4">
        <div class="col">
            <div class="card h-100 shadow-sm">
                <img src="https://source.unsplash.com/400x300/?laptop" class="card-img-top" alt="Laptop">
                <div class="card-body">
                    <h5 class="card-title">Laptop Pro</h5>
                    <p class="card-text">High performance laptop for all your needs.</p>
                    <p class="fw-bold text-primary">$999</p>
                    <a href="#" class="btn btn-success w-100">Add to Cart</a>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card h-100 shadow-sm">
                <img src="https://source.unsplash.com/400x300/?smartphone" class="card-img-top" alt="Smartphone">
                <div class="card-body">
                    <h5 class="card-title">Smartphone X</h5>
                    <p class="card-text">Latest generation smartphone with amazing features.</p>
                    <p class="fw-bold text-primary">$799</p>
                    <a href="#" class="btn btn-success w-100">Add to Cart</a>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card h-100 shadow-sm">
                <img src="https://source.unsplash.com/400x300/?headphones" class="card-img-top" alt="Headphones">
                <div class="card-body">
                    <h5 class="card-title">Wireless Headphones</h5>
                    <p class="card-text">Experience music like never before.</p>
                    <p class="fw-bold text-primary">$199</p>
                    <a href="#" class="btn btn-success w-100">Add to Cart</a>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
