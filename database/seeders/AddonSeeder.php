<?php

namespace Database\Seeders;

use App\Models\Addon;
use Illuminate\Database\Seeder;

class AddonSeeder extends Seeder
{
    public function run(): void
    {
        Addon::create(['name' => 'Extra Cheese', 'price' => 1.50]);
        Addon::create(['name' => 'Bacon Strip', 'price' => 2.00]);
        Addon::create(['name' => 'Large Fries', 'price' => 3.50]);
        Addon::create(['name' => 'Spicy Sauce', 'price' => 0.50]);
    }
}
