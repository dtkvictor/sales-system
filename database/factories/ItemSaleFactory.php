<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Product;
use App\Models\Sale;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ItemSale>
 */
class ItemSaleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $sale = (Sale::all())->random();
        $product = (Product::all())->random();

        return [
            'sale_id' => $sale->id,
            'product_id' => $product->id,
            'amount' => rand(1, 10),
            'unit_price' => fake()->randomFloat(2, 0.01, 9999.99)
        ];
    }
}
