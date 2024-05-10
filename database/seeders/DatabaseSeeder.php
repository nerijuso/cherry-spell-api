<?php

namespace Database\Seeders;

use App\Models\Enums\SubscriptionPlanHighlightedOption;
use App\Models\Enums\SubscriptionPlanPeriodType;
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
            'name' => '12-month membership',
            'ref_id' => 'price_1P9Y9OJ9G5oEDfjdPIHz0grO',
            'old_price' => '25.99',
            'price' => '9.09',
            'period' => SubscriptionPlanPeriodType::YEARLY,
            'highlighted_option' => SubscriptionPlanHighlightedOption::BEST_VALUE,
            'configuration' => [
                'price_item' => [
                    "period" => "per month",
                    "save_percentage" => 65,
                    "desc" => "$109.15 billed every 12 months"
                ]
            ],
        ]);

        SubscriptionPlan::factory()->create([
            'name' => '6-month membership',
            'ref_id' => 'price_1PEnzKJ9G5oEDfjdkARG8uoe',
            'old_price' => '29.99',
            'price' => '14.99',
            'period' => SubscriptionPlanPeriodType::EVERY_SIX_MONTHS,
            'configuration' => [
                'price_item' => [
                    "period" => "per month",
                    "save_percentage" => 50,
                    "desc" => "$89.97 billed every 6 months"
                ]
            ],

        ]);

        SubscriptionPlan::factory()->create([
            'name' => '3-month membership',
            'ref_id' => 'price_1P8owuJ9G5oEDfjdAm68mz5y',
            'old_price' => null,
            'price' => '35.99',
            'period' => SubscriptionPlanPeriodType::EVERY_THREE_MONTHS,
            'configuration' => [
                'price_item' => [
                    "period" => "per month",
                    "save_percentage" => null,
                    "desc" => "$107.97 billed every 3 months"
                ]
            ],
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

                foreach ((new FunnelQuizQuestionOption())->imageSizes as $size) {
                    if (isset($demoOption->{'img_'.$size})) {
                        $option->saveFile(public_path($demoOption->{'img_'.$size}), null, $size);
                    }
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
            'data' => [],
            'configuration' => [
                'image' => [
                    'size_1x' => 'https://cherryspell.nerijuso.lt/storage/funnel/frame_1.svg',
                    'size_2x' => '',
                ],
                'image_mobile' => [
                    'size_1x' => 'https://cherryspell.nerijuso.lt/storage/funnel/frame_1.svg',
                    'size_2x' => '',
                ],
                'content' => 'Before we continue with more intimate questions about your sex life, we want to assure you that all your responses are confidential and secure',
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
            'configuration' => [
                'layout' => 'column',
            ],
        ]);

        FunnelPage::factory()->create([
            'funnel_id' => $funnel->id,
            'type' => 'funnel_page_question',
            'is_active' => true,
            'position' => 80,
            'data' => ['question_id' => 7],
            'configuration' => [
                'layout' => 'column',
            ],
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
            'configuration' => [
                'layout' => 'row',
            ],
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
            'data' => [],
            'configuration' => [
                'image' => [
                    'size_1x' => 'https://cherryspell.nerijuso.lt/storage/funnel/Frame1214135874.png',
                    'size_2x' => '',
                ],
                'image_mobile' => [
                    'size_1x' => 'https://cherryspell.nerijuso.lt/storage/funnel/frame_1.svg',
                    'size_2x' => '',
                ],
                'title' => 'YWe’ve already helped 100,000+ couples. We’ll help you, too.',
                'sub_title' => '',
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
                'title' => "All set! We're now creating your  personal plan...",
                'content_list' => ['Analyzing your answers', 'Reviewing your habits', 'Building your summary', 'Finalizing your personal plan'],
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
                'content' => 'Enter your email to unlock your personalized summary and see how Cherry Spell can help you reignite your passion.',
                'rules_checkbox' => 'I agree to get future information from the Cherry Spell team.',
                'info' => 'Your personal data is safe. We don’t send spam or share email addresses with third parties. Unsubscribe any time.',
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
