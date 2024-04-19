<?php

namespace Database\Factories\FunnelQuiz;

use Illuminate\Database\Eloquent\Factories\Factory;

class FunnelQuizQuestionOptionFactory extends Factory
{
    public function definition(): array
    {
        return [
            'option' => fake()->name(),
            'is_active' => 1,
            'funnel_quiz_question_id' => 1,
        ];
    }
}
