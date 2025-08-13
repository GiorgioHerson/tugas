<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class storeController extends Controller
{
    public function index()
    {
        $title = "Welcome to the Store!";
        $subtitle = "Your one-stop shop for everything!";
        $products = [
            [
                'name' => 'Laptop',
                'price' => 999.99,
                'image' => 'images/laptop.webp',
                'description' => 'High-performance laptop for work and play.'
            ],
            [
                'name' => 'Smartphone',
                'price' => 499.99,
                'image' => 'images/smartphone.jpg',
                'description' => 'Latest model smartphone with advanced features.'
            ],
            [
                'name' => 'Headphones',
                'price' => 199.99,
                'image' => 'images/headphones.webp',
                'description' => 'Noise-cancelling headphones for immersive sound.'
            ],
            [
                'name' => 'Smartwatch',
                'price' => 299.99,
                'image' => 'images/smartwatch.webp',
                'description' => 'Smartwatch with fitness tracking and notifications.'
            ],
        ];
        return view('home', compact('products', 'title', 'subtitle')); // compact('title'));
    }
}