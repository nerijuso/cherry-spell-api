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
        Schema::create('funnel_quizzes', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->tinyInteger('is_published')->default(0)->index(); //0 means not published, 1 means published
            $table->timestamps();
        });

        Schema::create('funnel_quiz_questions', function (Blueprint $table) {
            $table->id();
            $table->text('question');
            $table->foreignId('funnel_quiz_id')->nullable()->constrained()->cascadeOnDelete();
            $table->text('description')->nullable();
            $table->string('media_file_name')->nullable();
            $table->string('handler')->nullable();
            $table->string('type')->nullable();
            $table->unsignedInteger('order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->index(['funnel_quiz_id', 'is_active']);
            $table->timestamps();
        });

        Schema::create('funnel_quiz_question_options', function (Blueprint $table) {
            $table->id();
            $table->foreignId('funnel_quiz_question_id')->nullable()->constrained()->cascadeOnDelete();
            $table->string('option')->nullable();
            $table->text('description')->nullable();
            $table->string('media_file_name')->nullable();
            $table->boolean('is_active')->default(true);
            $table->unsignedInteger('order')->default(0);
            $table->index(['funnel_quiz_question_id', 'is_active'], 'f_q_q_id_i_active');
            $table->timestamps();
        });

        Schema::create('funnel_quiz_user_answers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->cascadeOnDelete();
            $table->foreignId('funnel_quiz_question_id')->nullable()->constrained()->cascadeOnDelete();
            $table->foreignId('funnel_quiz_question_option_id')->nullable()->constrained()->cascadeOnDelete();
            $table->string('answer')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('funnel_quiz_user_answers');
        Schema::dropIfExists('funnel_quiz_question_options');
        Schema::dropIfExists('funnel_quiz_questions');
        Schema::dropIfExists('funnel_quizzes');
    }
};
