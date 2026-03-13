<?php

namespace Database\Factories;

use App\Models\Job;
use App\Models\User;
use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

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
            'title' => fake()->jobTitle(),
            'slug' => fake()->slug() . '-' . uniqid(),
            'description' => fake()->paragraph(3),
            'requirements' => fake()->paragraph(2),
            'type' => fake()->randomElement(['full_time', 'part_time', 'remote', 'contract']),
            'location' => fake()->city() . ', ' . fake()->country(),
            'salary_min' => fake()->numberBetween(1000, 5000),
            'salary_max' => fake()->numberBetween(5000, 15000),
            'is_active' => true,
            'deadline' => fake()->dateTimeBetween('now', '+3 months'),
            'user_id' => User::factory(['role' => 'employer']),
            'company_id' => Company::factory(),
        ];
    }

    /**
     * Create an inactive job
     */
    public function inactive(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_active' => false,
        ]);
    }

    /**
     * Create a remote job
     */
    public function remote(): static
    {
        return $this->state(fn (array $attributes) => [
            'type' => 'remote',
            'location' => 'Remote',
        ]);
    }

    /**
     * Create a full-time job
     */
    public function fullTime(): static
    {
        return $this->state(fn (array $attributes) => [
            'type' => 'full_time',
        ]);
    }
}
