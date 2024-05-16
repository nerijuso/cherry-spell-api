<?php

namespace Database\Seeders;

use App\Models\CMS\Post;
use App\Models\CMS\Tag;
use App\Models\Enums\SubscriptionPlanHighlightedOption;
use App\Models\Enums\SubscriptionPlanPeriodType;
use App\Models\Enums\SubscriptionPlanType;
use App\Models\Funnel;
use App\Models\FunnelPage;
use App\Models\FunnelQuiz\FunnelQuiz;
use App\Models\FunnelQuiz\FunnelQuizQuestion;
use App\Models\FunnelQuiz\FunnelQuizQuestionOption;
use App\Models\Subscription\PromoCode;
use App\Models\Subscription\SubscriptionPlan;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

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
        $tags = $this->seedTags();
        for ($i = 0; $i <= 10; $i++) {
            $this->seedPosts($tags, $i);
        }
    }

    private function seedSubscriptionPlans()
    {
        $promo50 = PromoCode::factory()->create([
            'name' => '50 % discount',
            'id' => 'QjUZwU12',
        ]);

        $promo65 = PromoCode::factory()->create([
            'name' => '65 % discount',
            'id' => 'tI9MGmIz',
        ]);

        $gift = SubscriptionPlan::factory()->create([
            'name' => '“Intimacy & Beyond” card deck',
            'ref_id' => 'price_1PGf0uLpRSg6kmyeBXHk8GoC',
            'old_price' => null,
            'price' => '0.01',
            'type' => SubscriptionPlanType::SUBSCRIPTION_GIFT,
            'period' => SubscriptionPlanPeriodType::ONE_TIME,
            'configuration' => [
                'price_item' => [
                    'desc' => 'Limited offer',
                ],
            ],
        ]);

        SubscriptionPlan::factory()->create([
            'name' => '12-month membership',
            'ref_id' => 'price_1PH2RKLpRSg6kmyeS8mNA88d',
            'old_price' => '25.99',
            'price' => '9.09',
            'free_gift_id' => $gift->ref_id,
            'promo_code_id' => $promo65->id,
            'type' => SubscriptionPlanType::SUBSCRIPTION_PLAN,
            'period' => SubscriptionPlanPeriodType::YEARLY,
            'highlighted_option' => SubscriptionPlanHighlightedOption::BEST_VALUE,
            'configuration' => [
                'price_item' => [
                    'period' => 'per month',
                    'save_percentage' => 65,
                    'desc' => '$109.15 billed every 12 months',
                ],
            ],
        ]);

        SubscriptionPlan::factory()->create([
            'name' => '6-month membership',
            'ref_id' => 'price_1PGz5NLpRSg6kmyevO3wHMMh',
            'old_price' => '29.99',
            'price' => '14.99',
            'promo_code_id' => $promo50->id,
            'type' => SubscriptionPlanType::SUBSCRIPTION_PLAN,
            'period' => SubscriptionPlanPeriodType::EVERY_SIX_MONTHS,
            'configuration' => [
                'price_item' => [
                    'period' => 'per month',
                    'save_percentage' => 50,
                    'desc' => '$89.97 billed every 6 months',
                ],
            ],

        ]);

        SubscriptionPlan::factory()->create([
            'name' => '3-month membership',
            'ref_id' => 'price_1PGz6PLpRSg6kmyezDqiSOFM',
            'old_price' => null,
            'price' => '35.99',
            'type' => SubscriptionPlanType::SUBSCRIPTION_PLAN,
            'period' => SubscriptionPlanPeriodType::EVERY_THREE_MONTHS,
            'configuration' => [
                'price_item' => [
                    'period' => 'per month',
                    'save_percentage' => null,
                    'desc' => '$107.97 billed every 3 months',
                ],
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
                'default_plan_id' => '1PH2RKLpRSg6kmyeS8mNA88d',
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

    private function seedTags(): array
    {
        $imgSizes = [];
        $tags = [];
        foreach ((new Tag())->imageSizes as $size) {
            $imgSizes[$size] = match ($size) {
                'size_1x' => '',
                'size_2x' => '@2x',
                'size_3x' => '@3x',
            };
        }

        $tag = Tag::factory()->create([
            'name' => 'Intimacy',
        ]);
        $tags[] = $tag->id;

        foreach ($imgSizes as $key => $size) {
            $tag->saveFile(public_path('demo/data/images/cms/fire_hot'.$size.'.png'), null, $key);
        }

        $tag = Tag::factory()->create([
            'name' => 'Commitment',
        ]);
        $tags[] = $tag->id;
        foreach ($imgSizes as $key => $size) {
            $tag->saveFile(public_path('demo/data/images/cms/heart'.$size.'.png'), null, $key);
        }

        $tag = Tag::factory()->create([
            'name' => 'Conflict resolution',
        ]);
        $tags[] = $tag->id;
        foreach ($imgSizes as $key => $size) {
            $tag->saveFile(public_path('demo/data/images/cms/smile_angry'.$size.'.png'), null, $key);
        }

        return $tags;
    }

    private function seedPosts($tags, $key)
    {
        $imgSizes = [];
        $domain = config('app.url');
        foreach ((new Post())->imageSizes as $size) {
            $imgSizes[$size] = match ($size) {
                'size_1x' => '',
                'size_2x' => '@2x',
                'size_3x' => '@3x',
            };
        }

        $post = Post::factory()->create([
            'title' => 'Explore the foundations of intimacy, from effective communication to embracing vulnerability '.$key,
            'slug' => Str::slug('Explore the foundations of intimacy, from effective communication to embracing vulnerability '.$key),
            'content' => "<p>Lorem ipsum dolor sit amet consectetur. Praesent netus lacus quam consequat tincidunt viverra. Pellentesque elementum sed ac adipiscing mauris odio. Pharetra donec aenean tortor et tristique fusce. Vel odio volutpat nibh facilisi faucibus euismod orci.</p><img src='{$domain}/demo/data/images/cms/post.png' alt='demo'/> <ul><li>Lorem ipsum dolor sit</li><li>Lorem ipsum dolor sit</li><li>Lorem ipsum dolor sit</li></ul><p>Lorem ipsum dolor sit amet consectetur. Praesent netus lacus quam consequat tincidunt viverra. Pellentesque elemen.</p><p><strong>Lorem ipsum dolor sit amet consectetur. Praesent netus lacus quam consequat tincidunt viverra. Pellentesque elementum sed ac adipiscing mauris odio.</strong></p><h1>Lorem ipsum dolor sit amet consectetur</h1><h2>Lorem ipsum dolor sit amet consectetur</h2><h3>Lorem ipsum</h3><h4>Lorem ipsum</h4><h5>Lorem ipsum</h5><h6>Lorem ipsum</h6>",
        ]);

        foreach ($imgSizes as $key => $size) {
            $post->saveFile(public_path('demo/data/images/cms/post'.$size.'.png'), null, $key);
        }

        $post->tags()->sync($tags);

        foreach ($tags as $tag) {
            $tagObj = Tag::find($tag);
            $tagObj->count++;
            $tagObj->save();
        }
    }
}
