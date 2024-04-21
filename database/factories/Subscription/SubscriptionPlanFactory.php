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
            'is_popular' => false,
            'has_trial' => false,
            'is_hidden' => false,
            'trial_days' => 3,
            'description' => "{}",
        ];
    }
}
