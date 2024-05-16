<?php

namespace Database\Factories\Subscription;

use Illuminate\Database\Eloquent\Factories\Factory;

class PromoCodeFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->title(),
            'id' => fake()->uuid(),
            'is_active' => true,
        ];
    }
}
