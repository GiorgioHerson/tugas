<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
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

        $sampleProducts = [
            'Groceries' => [
                ['name' => 'Rice 5kg', 'description' => 'High quality rice', 'image' => 'rice.jpg', 'price' => 70000],
                ['name' => 'Cooking Oil', 'description' => 'Premium cooking oil', 'image' => 'oil.jpg', 'price' => 40000],
                ['name' => 'Sugar', 'description' => 'Refined sugar', 'image' => 'sugar.jpg', 'price' => 25000],
                ['name' => 'Salt', 'description' => 'Sea salt', 'image' => 'salt.jpg', 'price' => 10000],
                ['name' => 'Eggs', 'description' => 'Fresh eggs', 'image' => 'eggs.jpg', 'price' => 30000],
            ],
            'Premium Fruits' => [
                ['name' => 'Apple Fuji', 'description' => 'Fresh Fuji apples', 'image' => 'apple_fuji.jpg', 'price' => 50000],
                ['name' => 'Banana Cavendish', 'description' => 'Sweet bananas', 'image' => 'banana.jpg', 'price' => 35000],
                ['name' => 'Grapes', 'description' => 'Seedless grapes', 'image' => 'grapes.jpg', 'price' => 60000],
                ['name' => 'Orange', 'description' => 'Juicy oranges', 'image' => 'orange.jpg', 'price' => 40000],
                ['name' => 'Pear', 'description' => 'Fresh pears', 'image' => 'pear.jpg', 'price' => 45000],
            ],
            'Home & Kitchen' => [
                ['name' => 'Blender', 'description' => 'High power blender', 'image' => 'blender.jpg', 'price' => 350000],
                ['name' => 'Toaster', 'description' => '2-slice toaster', 'image' => 'toaster.jpg', 'price' => 250000],
                ['name' => 'Rice Cooker', 'description' => 'Electric rice cooker', 'image' => 'rice_cooker.jpg', 'price' => 400000],
                ['name' => 'Kettle', 'description' => 'Electric kettle', 'image' => 'kettle.jpg', 'price' => 150000],
                ['name' => 'Pan', 'description' => 'Non-stick pan', 'image' => 'pan.jpg', 'price' => 120000],
            ],
            'Fashion' => [
                ['name' => 'T-Shirt', 'description' => 'Comfortable cotton t-shirt', 'image' => 'tshirt.jpg', 'price' => 80000],
                ['name' => 'Jeans', 'description' => 'Slim fit jeans', 'image' => 'jeans.jpg', 'price' => 150000],
                ['name' => 'Jacket', 'description' => 'Windbreaker jacket', 'image' => 'jacket.jpg', 'price' => 200000],
                ['name' => 'Sneakers', 'description' => 'Sporty sneakers', 'image' => 'sneakers.jpg', 'price' => 250000],
                ['name' => 'Cap', 'description' => 'Stylish cap', 'image' => 'cap.jpg', 'price' => 50000],
            ],
            'Electronics' => [
                ['name' => 'Smartphone', 'description' => 'Latest model smartphone', 'image' => 'smartphone.jpg', 'price' => 7000000],
                ['name' => 'Laptop', 'description' => 'High performance laptop', 'image' => 'laptop.jpg', 'price' => 12000000],
                ['name' => 'Headphones', 'description' => 'Noise cancelling headphones', 'image' => 'headphones.jpg', 'price' => 800000],
                ['name' => 'Smartwatch', 'description' => 'Fitness smartwatch', 'image' => 'smartwatch.jpg', 'price' => 2000000],
                ['name' => 'Tablet', 'description' => 'Android tablet', 'image' => 'tablet.jpg', 'price' => 3500000],
            ],
            'Home Improvement' => [
                ['name' => 'Drill Machine', 'description' => 'Electric drill for home improvement', 'image' => 'drill.jpg', 'price' => 450000],
                ['name' => 'Hammer', 'description' => 'Steel hammer', 'image' => 'hammer.jpg', 'price' => 60000],
                ['name' => 'Screwdriver Set', 'description' => 'Multi-size screwdriver set', 'image' => 'screwdriver.jpg', 'price' => 80000],
                ['name' => 'Paint Brush', 'description' => 'Quality paint brush', 'image' => 'paint_brush.jpg', 'price' => 30000],
                ['name' => 'Tape Measure', 'description' => '5m tape measure', 'image' => 'tape_measure.jpg', 'price' => 25000],
            ],
            'Sports' => [
                ['name' => 'Football', 'description' => 'Official size football', 'image' => 'football.jpg', 'price' => 150000],
                ['name' => 'Basketball', 'description' => 'Indoor/outdoor basketball', 'image' => 'basketball.jpg', 'price' => 180000],
                ['name' => 'Tennis Racket', 'description' => 'Lightweight tennis racket', 'image' => 'tennis_racket.jpg', 'price' => 350000],
                ['name' => 'Badminton Shuttlecock', 'description' => 'Pack of shuttlecocks', 'image' => 'shuttlecock.jpg', 'price' => 40000],
                ['name' => 'Yoga Mat', 'description' => 'Non-slip yoga mat', 'image' => 'yoga_mat.jpg', 'price' => 90000],
            ],
        ];

        foreach ($categories as $categoryName) {
            $category = \App\Models\ProductCategory::where('name', $categoryName)->first();
            if ($category) {
                foreach ($sampleProducts[$categoryName] as $product) {
                    \App\Models\Product::firstOrCreate([
                        'name' => $product['name'],
                    ], [
                        'description' => $product['description'],
                        'stock' => rand(10, 200),
                        'image' => $product['image'],
                        'price' => $product['price'],
                        'product_category_id' => $category->id,
                    ]);
                }
            }
        }
    }
}