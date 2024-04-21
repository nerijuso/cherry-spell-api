<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class FunnelPageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'type' => fake()->name(),
            'next_page_id' => null,
            'is_active' => true,
            'position' => 0,
            'data' => '{}',
            'configuration' => '{}',
        ];
    }
}
