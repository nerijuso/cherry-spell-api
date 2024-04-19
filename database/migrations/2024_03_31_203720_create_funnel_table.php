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
        Schema::create('funnels', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->boolean('is_active')->index();
            $table->json('configuration');
            $table->timestamps();
        });

        Schema::create('funnel_pages', function (Blueprint $table) {
            $table->id();
            $table->string('type')->nullable()->index();
            $table->foreignId('funnel_id')->constrained()->cascadeOnDelete();
            $table->integer('next_page_id')->nullable()->default(null);
            $table->boolean('is_active')->default(true);
            $table->integer('position')->default(0);
            $table->json('data')->nullable();
            $table->json('configuration')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('funnel_pages');
        Schema::dropIfExists('funnels');
    }
};
