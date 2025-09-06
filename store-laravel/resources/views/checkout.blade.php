<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - MegaMart</title>
    @vite('resources/css/page.css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
</head>
<body>
<x-header />
<div class="cart-container" style="max-width: 700px; margin: 40px auto; background: #fff; border-radius: 10px; box-shadow: 0 2px 8px rgba(0,0,0,0.07); padding: 32px 24px 24px 24px;">
    <h2 style="text-align: center; margin-bottom: 32px; color: #2d3748;">Checkout</h2>
    @if(!empty($cart))
    <table style="width: 100%; border-collapse: collapse; margin-bottom: 24px;">
        <thead>
            <tr>
                <th style="background: #f1f5f9; color: #374151; font-weight: 600; border-bottom: 2px solid #e2e8f0; padding: 12px 8px;">#</th>
                <th style="background: #f1f5f9; color: #374151; font-weight: 600; border-bottom: 2px solid #e2e8f0; padding: 12px 8px;">Product</th>
                <th style="background: #f1f5f9; color: #374151; font-weight: 600; border-bottom: 2px solid #e2e8f0; padding: 12px 8px;">Qty</th>
                <th style="background: #f1f5f9; color: #374151; font-weight: 600; border-bottom: 2px solid #e2e8f0; padding: 12px 8px;">Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($cart as $index => $item)
            <tr>
                <td style="padding: 12px 8px; border-bottom: 1px solid #e2e8f0;">{{ $index + 1 }}</td>
                <td style="padding: 12px 8px; border-bottom: 1px solid #e2e8f0;">
                    <div style="display: flex; align-items: center;">
                        <img src="{{ asset('storage/' . $item['image']) }}" alt="{{ $item['name'] }}" style="width: 40px; height: 40px; object-fit: cover; border-radius: 6px; margin-right: 10px;">
                        <span>{{ $item['name'] }}</span>
                    </div>
                </td>
                <td style="padding: 12px 8px; border-bottom: 1px solid #e2e8f0; text-align: center;">{{ $item['quantity'] }}</td>
                <td style="padding: 12px 8px; border-bottom: 1px solid #e2e8f0;">Rp {{ number_format($item['subtotal'], 0, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div style="text-align: right; font-size: 1.1rem; font-weight: bold; color: #2563eb; margin-bottom: 16px;">
        Grand Total: Rp {{ number_format($grandTotal, 0, ',', '.') }}
    </div>
    <form action="{{ route('checkout.process') }}" method="POST" style="margin-top: 32px;">
        @csrf
        <div style="margin-bottom: 16px;">
            <label for="name" style="display: block; margin-bottom: 6px; color: #374151;">Name</label>
            <input type="text" id="name" name="name" required style="width: 100%; padding: 8px; border-radius: 4px; border: 1px solid #e2e8f0;">
        </div>
        <div style="margin-bottom: 16px;">
            <label for="phone" style="display: block; margin-bottom: 6px; color: #374151;">Phone Number</label>
            <input type="number" id="phone" name="phone" required style="width: 100%; padding: 8px; border-radius: 4px; border: 1px solid #e2e8f0;">
        </div>
        <div style="margin-bottom: 16px;">
            <label for="address" style="display: block; margin-bottom: 6px; color: #374151;">Address</label>
            <textarea id="address" name="address" required style="width: 100%; padding: 8px; border-radius: 4px; border: 1px solid #e2e8f0;"></textarea>
        </div>
        <div style="text-align: center;">
        <button
            type="submit"
            style="padding: 10px 32px; background: #165bee; color: #fff; border: none; border-radius: 4px; font-size: 1.1rem; cursor: pointer;"
        >Place Order</button>
    </form>
    </div>
    @else
    <div style="text-align: center; color: #64748b; padding: 40px 0;">
        <i class="fas fa-shopping-cart" style="font-size: 2.5rem; margin-bottom: 12px;"></i>
        <p>Your cart is empty</p>
        <a href="{{ route('store.index') }}" style="padding: 6px 14px; background: #2563eb; color: #fff; border: none; border-radius: 4px; cursor: pointer; text-decoration: none;">Continue Shopping</a>
    </div>
    @endif
</div>
<x-footer />
</body>
</html>



