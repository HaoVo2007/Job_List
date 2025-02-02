<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Job;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Job>
 */
class JobFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->jobTitle,
            'description' => implode("\n", fake()->paragraphs()),
            'salary' => fake()->numberBetween(1000, 2000),
            'location' => fake()->city,
            'category' => fake()->randomElement(Job::$category),
            'experience' => fake()->randomElement(Job::$experience),
        ];
    }
}
