<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $burgers = Category::where('slug', 'burgers')->first();
        if ($burgers) {
            Product::create([
                'category_id' => $burgers->id,
                'name' => 'Classic Cheeseburger',
                'slug' => 'classic-cheeseburger',
                'description' => 'Beef patty with cheddar cheese, lettuce, tomato.',
                'price' => 9.99,
                'is_active' => true,
            ]);
            Product::create([
                'category_id' => $burgers->id,
                'name' => 'Bacon Deluxe',
                'slug' => 'bacon-deluxe',
                'description' => 'Double beef patty with crispy bacon.',
                'price' => 12.99,
                'is_active' => true,
            ]);
        }

        $drinks = Category::where('slug', 'drinks')->first();
        if ($drinks) {
            Product::create([
                'category_id' => $drinks->id,
                'name' => 'Cola',
                'slug' => 'cola',
                'description' => 'Chilled cola.',
                'price' => 2.50,
                'is_active' => true,
            ]);
        }
    }
}
