<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class FunnelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'is_active' => true,
            'configuration' => '{}',
        ];
    }
}
