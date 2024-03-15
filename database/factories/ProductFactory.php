<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Category;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->name();
        $category = Category::all();
        $category = $category->random();

        return [
            'thumb' => fake()->imageUrl(640, 480),
            'name' => $name,
            'slug' => Str::slug($name),
            'price' => fake()->randomFloat(2, 0.01, 9999.99),
            'inventory' => rand(0, 100),
            'description' => fake()->text(),
            'category_id' => $category->id,
        ];
    }
}
