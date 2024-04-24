<?php

namespace Database\Seeders;

use App\Models\Funnel;
use App\Models\FunnelPage;
use App\Models\FunnelQuiz\FunnelQuiz;
use App\Models\FunnelQuiz\FunnelQuizQuestion;
use App\Models\FunnelQuiz\FunnelQuizQuestionOption;
use App\Models\Subscription\SubscriptionPlan;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $this->seedFunnelQuizQuestionWithoptions();
        $this->seedSubscriptionPlans();
        $this->seedFunnel();
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

        foreach (json_decode(file_get_contents(public_path('demo/data/seeder/questions.json'))) as $key => $demo) {
            $question = FunnelQuizQuestion::factory()->create([
                'question' => $demo->question,
                'description' => $demo->description,
                'funnel_quiz_id' => $quiz->id,
                'type' => $demo->type,
                'order' => 10 * $key,
            ]);
            foreach ($demo->options as $keyOption => $demoOption) {
                $option = FunnelQuizQuestionOption::factory()->create([
                    'option' => $demoOption->name,
                    'description' => $demoOption->description,
                    'funnel_quiz_question_id' => $question->id,
                    'order' => $keyOption * 10,
                ]);

                if (isset($demoOption->media_file_name_1x)) {
                    $option->saveFile(public_path($demoOption->media_file_name_1x), null, '1x');
                }
                if (isset($demoOption->media_file_name_2x)) {
                    $option->saveFile(public_path($demoOption->media_file_name_2x), null, '2x');
                }
                if (isset($demoOption->media_file_name_3x)) {
                    $option->saveFile(public_path($demoOption->media_file_name_3x), null, '3x');
                }
            }
        }

    }

    private function seedFunnel()
    {
        $funnel = Funnel::factory()->create([
            'name' => 'Funnel 1',
        ]);

        FunnelPage::factory()->create([
            'funnel_id' => $funnel->id,
            'type' => 'funnel_page_landing_question',
            'is_active' => true,
            'position' => 10,
            'data' => ['question_id' => 1],
            'configuration' => [],
        ]);

        FunnelPage::factory()->create([
            'funnel_id' => $funnel->id,
            'type' => 'funnel_page_question',
            'is_active' => true,
            'position' => 20,
            'data' => ['question_id' => 2],
            'configuration' => [],
        ]);

        FunnelPage::factory()->create([
            'funnel_id' => $funnel->id,
            'type' => 'funnel_page_question',
            'is_active' => true,
            'position' => 30,
            'data' => ['question_id' => 3],
            'configuration' => [],
        ]);

        FunnelPage::factory()->create([
            'funnel_id' => $funnel->id,
            'type' => 'funnel_page_question',
            'is_active' => true,
            'position' => 40,
            'data' => ['question_id' => 4],
            'configuration' => [],
        ]);

        $funnelPage = FunnelPage::factory()->create([
            'funnel_id' => $funnel->id,
            'type' => 'funnel_page_text_with_logo',
            'is_active' => true,
            'position' => 50,
            'data' => [
                'media_file_name_1x' => '',
                'media_file_name_2x' => '',
                'media_file_name_3x' => '',
            ],
            'configuration' => [
                'content' => 'Before we proceed with more intimate questions about your sex life, we want to assure you that your responses and personal information are kept confidential and secure.',
            ],
        ]);

        FunnelPage::factory()->create([
            'funnel_id' => $funnel->id,
            'type' => 'funnel_page_question',
            'is_active' => true,
            'position' => 60,
            'data' => ['question_id' => 5],
            'configuration' => [],
        ]);

        FunnelPage::factory()->create([
            'funnel_id' => $funnel->id,
            'type' => 'funnel_page_question',
            'is_active' => true,
            'position' => 70,
            'data' => ['question_id' => 6],
            'configuration' => [],
        ]);

        FunnelPage::factory()->create([
            'funnel_id' => $funnel->id,
            'type' => 'funnel_page_question',
            'is_active' => true,
            'position' => 80,
            'data' => ['question_id' => 7],
            'configuration' => [],
        ]);

        FunnelPage::factory()->create([
            'funnel_id' => $funnel->id,
            'type' => 'funnel_page_question',
            'is_active' => true,
            'position' => 90,
            'data' => ['question_id' => 8],
            'configuration' => [],
        ]);

        FunnelPage::factory()->create([
            'funnel_id' => $funnel->id,
            'type' => 'funnel_page_question',
            'is_active' => true,
            'position' => 100,
            'data' => ['question_id' => 9],
            'configuration' => [],
        ]);

        FunnelPage::factory()->create([
            'funnel_id' => $funnel->id,
            'type' => 'funnel_page_question',
            'is_active' => true,
            'position' => 110,
            'data' => ['question_id' => 10],
            'configuration' => [],
        ]);

        $funnelPage = FunnelPage::factory()->create([
            'funnel_id' => $funnel->id,
            'type' => 'funnel_page_review',
            'is_active' => true,
            'position' => 120,
            'data' => [
                'media_file_name_1x' => '',
                'media_file_name_2x' => '',
                'media_file_name_3x' => '',
            ],
            'configuration' => [
                'title' => 'Yes, it actually works',
                'sub_title' => 'Loved by couples just like yours.',
                'content' => "It literally saved our relationship. My hubby and I are feeling much closer and more intimate in a way we haven't in ages (we've been married 7 years).  It’s full of actionable tips that help you understand each other’s needs better.",
                'content_author' => 'Emma & Phil, NY, USA',
            ],
        ]);

        FunnelPage::factory()->create([
            'funnel_id' => $funnel->id,
            'type' => 'funnel_page_loader',
            'is_active' => true,
            'position' => 130,
            'data' => [],
            'configuration' => [
                'title' => "All set! We'll need a moment to analyze your data...",
                'content_list' => ['Analyzing your answers', 'Reviewing your habits', 'Building your summary', 'Finalizing your personal plan'],
                'slider' => [
                    [
                        'images' => [
                            'media_file_name_1x' => '',
                            'media_file_name_2x' => '',
                            'media_file_name_3x' => '',
                        ],
                    ],
                    [
                        'images' => [
                            'media_file_name_1x' => '',
                            'media_file_name_2x' => '',
                            'media_file_name_3x' => '',
                        ],
                    ],
                ],
            ],
        ]);

        FunnelPage::factory()->create([
            'funnel_id' => $funnel->id,
            'type' => 'funnel_page_submit_quiz',
            'is_active' => true,
            'position' => 140,
            'data' => [],
            'configuration' => [
                'title' => 'Your results are ready',
                'content' => 'Enter your email to unlock your personalized summary and see how Cherry Spell can help you to reignite the passion you once had.',
                'rules_checkbox' => 'I agree to get future information from Cherry Spell team.',
                'info' => 'Your personal data is safe with us. Also, we don’t send spam or share email addresses with third parties.',
            ],
        ]);

        FunnelPage::factory()->create([
            'funnel_id' => $funnel->id,
            'type' => 'funnel_page_summary',
            'is_active' => true,
            'position' => 150,
            'data' => [],
            'configuration' => [],
        ]);

        FunnelPage::factory()->create([
            'funnel_id' => $funnel->id,
            'type' => 'funnel_page_plans',
            'is_active' => true,
            'position' => 160,
            'data' => [
                'subscription_plan_ids' => [1, 2, 3],
            ],
            'configuration' => [
            ],
        ]);

        FunnelPage::factory()->create([
            'funnel_id' => $funnel->id,
            'type' => 'funnel_page_payment',
            'is_active' => true,
            'position' => 170,
            'data' => [],
            'configuration' => [],
        ]);

        FunnelPage::factory()->create([
            'funnel_id' => $funnel->id,
            'type' => 'funnel_page_payment_status',
            'is_active' => true,
            'position' => 180,
            'data' => [],
            'configuration' => [],

        ]);
    }
}
