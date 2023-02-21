<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Movie>
 */
class MovieFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => fake()->words(rand(1, 5), true),
            'director' => fake()->firstName() . ' ' . fake()->lastName(),
            'prod_year' => fake()->year('now'),
            'expenses' => fake()->numberBetween(100, 3000),
            'cashout' => fake()->numberBetween(300, 5000),
        ];
    }
}