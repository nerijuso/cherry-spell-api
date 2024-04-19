<?php

namespace Database\Seeders;

use App\Models\FunnelQuiz\FunnelQuiz;
use App\Models\FunnelQuiz\FunnelQuizQuestion;
use App\Models\FunnelQuiz\FunnelQuizQuestionOption;
use App\Models\Subscription\SubscriptionPlan;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $this->seedFunnelQuizQuestionWithoptions();
        $this->seedSubscriptionPlans();
    }

    private function seedSubscriptionPlans()
    {
        SubscriptionPlan::factory()->create([
            'name' => '7-day plan',
            'price' => '1',
        ]);

        SubscriptionPlan::factory()->create([
            'name' => '1-month plan',
            'price' => '10',
        ]);

        SubscriptionPlan::factory()->create([
            'name' => '3-month plan',
            'price' => '30',
        ]);
    }

    private function seedFunnelQuizQuestionWithoptions()
    {
        $quiz = FunnelQuiz::factory()->create([
            'title' => 'General questions',
        ]);

        foreach (json_decode(Storage::disk('local')->get('data/seeder/questions.json')) as $key => $demo) {

            $question = FunnelQuizQuestion::factory()->create([
                'question' => $demo->question,
                'description' => $demo->description,
                'funnel_quiz_id' => $quiz->id,
                'type' => $demo->type,
                'order' => 10 * $key,
            ]);
            foreach ($demo->options as $keyOption => $demoOption) {
                FunnelQuizQuestionOption::factory()->create([
                    'option' => $demoOption->name,
                    'description' => $demoOption->description,
                    'funnel_quiz_question_id' => $question->id,
                    'order' => $keyOption * 10,
                ]);
            }
        }

    }
}
