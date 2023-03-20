<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->sentence(3),
            'isbn_13' => fake()->isbn13(),
            'publisher_id' => fake()->numberBetween(1, 5),
            'num_pages' => fake()->numberBetween(50, 700),
            'publication_date' => fake()->date(),
            'price' => fake()->randomFloat(2, 10, 100)
        ];
    }
}
