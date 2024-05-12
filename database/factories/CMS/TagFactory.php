<?php

namespace Database\Factories\CMS;

use Illuminate\Database\Eloquent\Factories\Factory;

class TagFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->title(),
            'position' => 0,
            'is_active' => true,
            'count' => 0,
        ];
    }
}
