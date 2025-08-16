<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            'Groceries',
            'Premium Fruits',
            'Home & Kitchen',
            'Fashion',
            'Electronics',
            'Home Improvement',
            'Sports',
        ];

        foreach ($categories as $category) {
            \App\Models\ProductCategory::firstOrCreate(['name' => $category]);
        }
    }
}
