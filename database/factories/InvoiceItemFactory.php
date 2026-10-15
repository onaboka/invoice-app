<?php

namespace Database\Factories;

use App\Models\Invoice;
use App\Models\InvoiceItem;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<InvoiceItem>
 */
class InvoiceItemFactory extends Factory
{
    protected $model = InvoiceItem::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'invoice_id' => $this->faker->numberBetween(100, 10000),
            'product_id' => $this->faker->numberBetween(100, 10000),
            'unit_price' => $this->faker->numberBetween(100, 10000),
            'quantity' => $this->faker->numberBetween(1, 10),
        ];
    }
}
