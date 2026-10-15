<?php

namespace Database\Factories;

use App\Models\Counter;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Counter>
 */
class CounterFactory extends Factory
{
    protected $model = Counter::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'key' => 'invoice',
            'prefix' => 'INV-',
            'value' => $this->faker->numberBetween(1000, 999999),
        ];
    }
}
