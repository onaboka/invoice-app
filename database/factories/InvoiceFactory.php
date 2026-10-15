<?php

namespace Database\Factories;

use App\Models\Invoice;
use Illuminate\Database\Eloquent\Factories\Factory;
use function Laravel\Prompts\number;

/**
 * @extends Factory<Invoice>
 */
class InvoiceFactory extends Factory
{
    protected $model = Invoice::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'number' => $this->faker->unique()->randomNumber(),
            'customer_id' => $this->faker->numberBetween(1, 20),
            'date' => $this->faker->date(),
            'due_date' => $this->faker->date(),
            'reference' => 'REF-'.rand(10, 500),
            'terms' => $this->faker->paragraph(),
            'sub_total' => $this->faker->numberBetween(100, 999999),
            'discount' => $this->faker->numberBetween(10, 100),
            'total' => $this->faker->numberBetween(100, 999999),
        ];
    }
}
