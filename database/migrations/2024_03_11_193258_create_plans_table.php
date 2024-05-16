<?php

use App\Models\Enums\SubscriptionPlanType;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('promo_codes', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('name');
            $table->boolean('is_active')->default(1);
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('subscription_plans', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('ref_id')->unique()->nullable();
            $table->string('product_ref_id')->nullable();
            $table->string('type')->default(SubscriptionPlanType::SUBSCRIPTION_PLAN);
            $table->decimal('old_price')->nullable();
            $table->decimal('price')->default(0);
            $table->string('highlighted_option')->nullable();
            $table->string('period')->nullable();
            $table->boolean('is_hidden')->default(false)->index();
            $table->string('free_gift_id')->nullable();
            $table->json('media_file')->nullable();
            $table->string('promo_code_id')->nullable();
            $table->foreign('promo_code_id')->references('id')->on('promo_codes');
            $table->integer('sort')->default(0);
            $table->json('configuration');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('promo_codes');
        Schema::dropIfExists('subscription_plans');
    }
};
