<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Website>
 */
class WebsiteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => fake()->name(),
            'domain' => fake()->domainName(),
            'public' => false
        ];
    }

    public function isPublic()
    {
        return $this->state(fn (array $attributes) => [
            'public' => true,
        ]);
    }
}
