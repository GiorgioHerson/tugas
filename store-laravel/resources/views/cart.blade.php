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
    <div class="cart-container" style="max-width: 700px; margin: 40px auto; background: #fff; border-radius: 10px; box-shadow: 0 2px 8px rgba(0,0,0,0.07); padding: 32px 24px 24px 24px;">
        <h2 style="text-align: center; margin-bottom: 32px; color: #2d3748;">Your Shopping Cart</h2>
        @if(!empty($cart))
        <table style="width: 100%; border-collapse: collapse; margin-bottom: 24px;">
            <thead>
                <tr>
                    <th style="background: #f1f5f9; color: #374151; font-weight: 600; border-bottom: 2px solid #e2e8f0; padding: 12px 8px;">#</th>
                    <th style="background: #f1f5f9; color: #374151; font-weight: 600; border-bottom: 2px solid #e2e8f0; padding: 12px 8px;">Product</th>
                    <th style="background: #f1f5f9; color: #374151; font-weight: 600; border-bottom: 2px solid #e2e8f0; padding: 12px 8px;">Price</th>
                    <th style="background: #f1f5f9; color: #374151; font-weight: 600; border-bottom: 2px solid #e2e8f0; padding: 12px 8px;">Quantity</th>
                    <th style="background: #f1f5f9; color: #374151; font-weight: 600; border-bottom: 2px solid #e2e8f0; padding: 12px 8px;">Total</th>
                    <th style="background: #f1f5f9; color: #374151; font-weight: 600; border-bottom: 2px solid #e2e8f0; padding: 12px 8px;">Actions</th>
                </tr>
            </thead>
            <tbody>
        @foreach($cart as $id => $item)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>
                <img src="{{ asset('storage/' . $item['image']) }}" alt="{{ $item['name'] }}" style="width: 50px; height: 50px; object-fit: cover;">
                <span class="ml-2">{{ $item['name'] }}</span>
            </td>
            <td>Rp {{ number_format($item['price'], 0, ',', '.') }}</td>
            <td>
                <form action="{{ route('cart.update', $id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('POST')
                    <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1" style="width: 60px;">
                    <button type="submit" class="btn btn-sm btn-primary"><i class="fas fa-sync-alt"></i></button>
                </form>
            </td>
            <td>Rp {{ number_format($subtotal, 0, ',', '.') }}</td>
            <td>
                <form action="{{ route('cart.remove', $id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('POST')
                    <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<div style="display: flex; flex-direction: column; align-items: center; gap: 10px;">    
    <h4>Grand Total: <span class="text-success">Rp {{ number_format($grandTotal, 0, ',', '.') }}</span></h4>
    <a href="{{ route('store.index') }}" class="btn btn-primary">Continue Shopping</a>
    <a href="{{ route('checkout') }}" class="btn btn-secondary">Proceed to Checkout</a>
    
</div>
@else
<div class="container">
    <div style="display: flex; flex-direction: column; align-items: center;">
        <i class="fas fa-shopping-cart text-gray-400 text-5xl mb-4"></i>
        <p class="text-gray-600">Your cart is empty</p>
    <a href="{{ route('store.index') }}" class="btn btn-primary mt-4">Continue Shopping</a>
</div>
@endif
</div>
<x-footer />
</body>
</html>