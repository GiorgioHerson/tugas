<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart - MegaMart</title>
    @vite('resources/css/page.css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
</head>
<body>

    <x-header />

    <main class="page-container">
        <h1 class="cart-title">My Shopping Cart</h1>
        <div class="cart-layout">
            <!-- Left: Cart Items -->
            <div class="cart-items-list">
                @php $subtotal = 0; @endphp
                @foreach ($items as $item)
                    <div class="cart-item">
                        <img src="{{ $item['image'] }}" alt="{{ $item['name'] }}" class="cart-item-image">
                        <div class="cart-item-details">
                            <p class="cart-item-name">{{ $item['name'] }}</p>
                            <p class="cart-item-price">₹{{ number_format($item['price']) }}</p>
                            <div class="cart-item-quantity">
                                <button>-</button>
                                <input type="text" value="{{ $item['quantity'] }}" readonly>
                                <button>+</button>
                            </div>
                        </div>
                        <button class="cart-item-remove">Remove</button>
                    </div>
                    @php $subtotal += $item['price'] * $item['quantity']; @endphp
                @endforeach
            </div>

            <!-- Right: Price Summary -->
            <div class="cart-summary">
                <h3 class="summary-title">Price Details</h3>
                <div class="summary-line">
                    <span>Subtotal</span>
                    <span>₹{{ number_format($subtotal) }}</span>
                </div>
                <div class="summary-line">
                    <span>Discount</span>
                    <span class="summary-discount">- ₹0</span>
                </div>
                <div class="summary-line">
                    <span>Shipping</span>
                    <span>FREE</span>
                </div>
                <hr>
                <div class="summary-total">
                    <span>Total Amount</span>
                    <span>₹{{ number_format($subtotal) }}</span>
                </div>
                <button class="btn btn-primary btn-full">Proceed to Checkout</button>
            </div>
        </div>
      </main>
      

</body>
</html>