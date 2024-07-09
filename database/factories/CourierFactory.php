<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Courier>
 */
class CourierFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'courier_type' => fake()->randomElement(['foot', 'bike', 'car']),
            'regions' => fake()->randomElements(range(1, 21), 3),
            'working_hours' => fake()->words(3),
        ];
    }
}
