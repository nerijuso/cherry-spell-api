<?php

namespace Database\Factories\FunnelQuiz;

use Illuminate\Database\Eloquent\Factories\Factory;

class FunnelQuizQuestionFactory extends Factory
{
    public function definition(): array
    {
        return [
            'question' => fake()->name(),
            'funnel_quiz_id' => 1,
            'is_active' => true,
        ];
    }
}
