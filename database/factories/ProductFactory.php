<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Product>
 */
class ProductFactory extends Factory
{
    protected $model = Product::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'item_code' => 'IC-1000'.rand(100, 999),
            'description' => 'Name of product'.rand(1, 100),
            'unit_price' => $this->faker->numberBetween(100, 999999),
        ];
    }
}
