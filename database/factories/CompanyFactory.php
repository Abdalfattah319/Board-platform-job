<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Company>
 */
class CompanyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'name' => fake()->company(),
            'description' => fake()->paragraph(3),
            'website' => 'https://' . fake()->slug() . '.com',
            'logo' => null,
        ];
    }

    /**
     * Create a company with jobs
     */
    public function withJobs(int $count = 3): static
    {
        return $this->has(
            \App\Models\Job::factory()->count($count),
            'jobs'
        );
    }
}
