<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index()
    {
    $cart = session()->get('cart', []);
    $grandTotal = 0;
    $subtotal = 0;
    foreach ($cart as $id => $item) {
        $cart[$id]['subtotal'] = $item['price'] * $item['quantity'];
        $subtotal = $item['price'] * $item['quantity'];
        $grandTotal += $subtotal;
    }

    return view('checkout', compact('cart', 'grandTotal' , 'subtotal'));
}



    public function processCheckout(Request $request)

    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart')->with('error', 'Your cart is empty!');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|integer|max:20',
            'address' => 'required|string|max:500',
        ]);
        
        $name = $request->input('name');
        $phone = $request->input('phone');
        $address = $request->input('address');


        // Format whatsapp message
        $message = "New Order from MegaMart%0A";
        $message .= "Name: $name%0A";
        $message .= "Phone Number: $phone%0A";
        $message .= "Address: $address%0A";
        $message .= "Order Details:%0A";
        $totalAmount = 0;
        foreach ($cart as $item) {
            $subtotal = $item['price'] * $item['quantity'];
            $totalAmount += $subtotal;
            $message .= "- {$item['name']} x {$item['quantity']} = Rp. " . number_format($subtotal, 0, ',', '.') . "%0A";
        }
        $message .= "Total Amount: Rp. " . number_format($totalAmount, 0, ',', '.') . "%0A";

        $whatsappNumber = '6281234567890'; 
        $whatsappUrl = "https://wa.me/$whatsappNumber?text=$message";

        session()->forget('cart');

        return redirect()->away($whatsappUrl);
        
    } 
} 