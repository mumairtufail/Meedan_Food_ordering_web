<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Burgers', 'slug' => 'burgers', 'description' => 'Juicy, flame-grilled burgers primarily made from beef.'],
            ['name' => 'Pizza', 'slug' => 'pizza', 'description' => 'Freshly baked pizzas with various toppings.'],
            ['name' => 'Drinks', 'slug' => 'drinks', 'description' => 'Refreshing soft drinks and juices.'],
            ['name' => 'Desserts', 'slug' => 'desserts', 'description' => 'Sweet treats to finish your meal.'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
