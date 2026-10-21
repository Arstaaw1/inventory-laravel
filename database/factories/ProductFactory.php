<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    public function definition(): array
    {
        return [
            'category_id' => Category::inRandomOrder()->first()?->id ?? Category::factory(),
            'sku' => strtoupper(fake()->unique()->bothify('SKU-#####')),
            'name' => fake()->words(3, true),
            'price' => fake()->randomFloat(2, 10000, 500000),
            'stock' => fake()->numberBetween(10, 100),
            'minimum_stock' => 5,
        ];
    }
}