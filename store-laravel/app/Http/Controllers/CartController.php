<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CartController extends Controller
{
  public function index()
    {
        $cartItems = [
            [
                'image' => 'images/Galaxy M13.jpg',
                'name' => 'Galaxy M13 (4GB | 64 GB)',
                'price' => 10499,
                'quantity' => 1,
            ],
            [
                'image' => 'images/Galaxy S22 Ultra.jpg',
                'name' => 'Galaxy S22 Ultra',
                'price' => 32999,
                'quantity' => 1,
            ]
        ];
        return view('cart', ['items' => $cartItems]);
    }
}