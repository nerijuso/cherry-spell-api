<?php

namespace App\Http\Controllers\Admin\FunnelQuizzes;

use App\Http\Controllers\Controller;
use App\Models\FunnelQuiz\FunnelQuiz;
use App\Models\FunnelQuiz\FunnelQuizQuestion;
use App\Models\FunnelQuiz\FunnelQuizQuestionOption;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FunnelQuestionOptionController extends Controller
{
    public function create(FunnelQuiz $quiz, FunnelQuizQuestion $question, FunnelQuizQuestionOption $option)
    {
        return view('admin.pages.quiz.question.option.create', [
            'quiz' => $quiz,
            'item' => $question,
            'option' => $option,
        ]);
    }

    public function edit(FunnelQuiz $quiz, FunnelQuizQuestion $question, FunnelQuizQuestionOption $option)
    {
        return view('admin.pages.quiz.question.option.edit', [
            'question' => $question,
            'quiz' => $quiz,
            'option' => $option,
        ]);
    }

    public function storeNew(FunnelQuiz $quiz, FunnelQuizQuestion $question, Request $request)
    {
        $request->validate([
            'option' => 'required|min:1|max:255',
            'order' => 'required|int|min:1|max:255',
            'is_active' => 'boolean',
            'media_file_name_1x' => 'file|image',
            'media_file_name_2x' => 'file|image',
            'media_file_name_3x' => 'file|image',
        ]);

        DB::transaction(function () use ($request, $question) {
            $questionOption = (new FunnelQuizQuestionOption())->create([
                'funnel_quiz_question_id' => $question->id,
                'option' => $request->option,
                'order' => $request->order,
                'is_active' => (bool) $request->is_active,
            ]);
            $questionOption->saveFile($request->media_file_name_1x, null, '1x');
            $questionOption->saveFile($request->media_file_name_2x, null, '2x');
            $questionOption->saveFile($request->media_file_name_3x, null, '3x');

            return $questionOption;
        });

        return redirect(route('admin.quizzes.questions.edit', ['quiz' => $quiz->id, 'question' => $question->id]));
    }

    public function update(FunnelQuizQuestion $quiz, FunnelQuizQuestion $question, FunnelQuizQuestionOption $option, Request $request)
    {
        $request->validate([
            'option' => 'required|min:1|max:255',
            'order' => 'required|int|min:1|max:255',
            'is_active' => 'boolean',
            'media_file_name_1x' => 'file|image',
            'media_file_name_2x' => 'file|image',
            'media_file_name_3x' => 'file|image',
        ]);


        DB::transaction(function () use ($request, $option) {
            $option->update([
                'option' => $request->option,
                'order' => $request->order,
                'is_active' => (bool) $request->is_active,
            ]);

            $option->saveFile($request->media_file_name_1x, null, '1x');
            $option->saveFile($request->media_file_name_2x, null, '2x');
            $option->saveFile($request->media_file_name_3x, null, '3x');

            return $option;
        });

        $request->session()->flash('alert-success', 'Task was successful!');

        return redirect(route('admin.quizzes.questions.edit', ['quiz' => $quiz->id, 'question' => $question->id]));
    }

    public function removeImage(FunnelQuiz $quiz, FunnelQuizQuestion $question, FunnelQuizQuestionOption $option, $size)
    {
        $option->removeFile($size);

        return back();
    }
}
