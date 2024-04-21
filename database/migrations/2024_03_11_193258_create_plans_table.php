<?php

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
        Schema::create('subscription_plans', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('ref_id')->unique()->nullable();
            $table->decimal('old_price')->nullable();
            $table->decimal('price')->default(0);
            $table->boolean('is_popular')->default(false)->index();
            $table->boolean('has_trial')->default(false)->index();
            $table->boolean('is_hidden')->default(false)->index();
            $table->integer('trial_days')->unsigned()->nullable();
            $table->integer('sort')->default(0);
            $table->json('description');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscription_plans');
    }
};
