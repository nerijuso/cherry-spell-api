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
        Schema::create('topics', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('topic');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('quizzes', function (Blueprint $table) {
            $table->id();
            $table->string('topic_id')->unique();
            $table->foreign('topic_id')
                ->references('id')->on('topics')
                ->onDelete('cascade');
            $table->string('title');
            $table->text('description')->nullable();
            $table->tinyInteger('is_published')->default(0)->index(); //0 means not published, 1 means published
            $table->timestamps();
        });

        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->text('question');
            $table->foreignId('quiz_id')->nullable()->constrained()->cascadeOnDelete();
            $table->string('media_file_name')->nullable();
            $table->string('type')->nullable();
            $table->unsignedInteger('order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->index(['quiz_id', 'is_active']);
            $table->timestamps();
        });

        Schema::create('question_options', function (Blueprint $table) {
            $table->id();
            $table->foreignId('question_id')->nullable()->constrained()->cascadeOnDelete();
            $table->string('option')->nullable();
            $table->string('media_file_name')->nullable();
            $table->boolean('is_active')->default(true);
            $table->unsignedInteger('order')->default(0);
            $table->index(['question_id', 'is_active']);
            $table->timestamps();
        });

        Schema::create('quiz_user_answers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->cascadeOnDelete();
            $table->foreignId('question_id')->nullable()->constrained()->cascadeOnDelete();
            $table->foreignId('question_option_id')->nullable()->constrained()->cascadeOnDelete();
            $table->string('answer')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quiz_user_answers');
        Schema::dropIfExists('question_options');
        Schema::dropIfExists('questions');
        Schema::dropIfExists('quizzes');
        Schema::dropIfExists('topics');
    }
};
