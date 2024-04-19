<?php

namespace Database\Factories\FunnelQuiz;

use Illuminate\Database\Eloquent\Factories\Factory;

class FunnelQuizFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => fake()->title(),
            'description' => fake()->text(50),
            'is_published' => true,
        ];
    }
}
