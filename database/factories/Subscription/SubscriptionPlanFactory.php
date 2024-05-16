<?php

namespace Database\Factories\Subscription;

use Illuminate\Database\Eloquent\Factories\Factory;

class SubscriptionPlanFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'ref_id' => fake()->uuid(),
            'highlighted_option' => null,
            'is_hidden' => false,
            'configuration' => '{}',
        ];
    }
}
