<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function show()
    {
        
        $product = [
            'image' => 'images/Galaxy M13.jpg',
            'name' => 'Galaxy M13 (4GB | 64 GB)',
            'current_price' => 10499,
            'original_price' => 14999,
            'description' => 'Super-powered with a 5nm Octa-core processor, your Galaxy is built to handle heavy-duty multitasking. RAM Plus reads your usage patterns and provides extra virtual RAM for an additional boost.'
        ];
        return view('product-details', ['product' => $product]);
    }
}

