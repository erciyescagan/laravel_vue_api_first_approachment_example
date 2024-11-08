<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Products>
 */
class ProductsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
         return [
            'name' => fake()->word(),
            'description' => fake()->paragraph(),
            'price' => fake()->numberBetween(1, 1000),
            'image' => fake()->imageUrl(640,480),
        ];
    }
}