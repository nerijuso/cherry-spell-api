<?php

namespace App\Http\Controllers\Admin\FunnelQuizzes;

use App\Http\Controllers\Controller;
use App\Models\Enums\FunnelQuizQuestionType;
use App\Models\FunnelQuiz\FunnelQuiz;
use App\Models\FunnelQuiz\FunnelQuizQuestion;
use App\Models\FunnelQuiz\FunnelQuizQuestionOption;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FunnelQuestionController extends Controller
{
    public function create(FunnelQuiz $quiz, FunnelQuizQuestion $question)
    {
        return view('admin.pages.quiz.question.create', [
            'quiz' => $quiz,
            'item' => $question,
            'types' => FunnelQuizQuestionType::all(),
        ]);
    }

    public function edit(FunnelQuiz $quiz, FunnelQuizQuestion $question)
    {
        return view('admin.pages.quiz.question.edit', [
            'question' => $question,
            'quiz' => $quiz,
            'types' => FunnelQuizQuestionType::all(),
            'questionOptions' => FunnelQuizQuestionOption::where('funnel_quiz_question_id', $question->id)->orderBy('order')->get(),
        ]);
    }

    public function storeNew(FunnelQuiz $quiz, Request $request)
    {
        $request->validate([
            'type' => 'required|string|in:'.implode(',', QuizQuestionType::all()),
            'question' => 'required|min:1|max:255',
            'order' => 'required|int|min:1|max:255',
            'is_active' => 'boolean',
            'media_file_name_1x' => 'file|image',
            'media_file_name_2x' => 'file|image',
            'media_file_name_3x' => 'file|image',
        ]);

        $question = DB::transaction(function () use ($request, $quiz) {
            $question = (new FunnelQuizQuestion())->create([
                'type' => $request->type,
                'funnel_quiz_id' => $quiz->id,
                'question' => $request->question,
                'order' => $request->order,
                'is_active' => (bool) $request->is_active,
            ]);
            $question->saveFile($request->media_file_name_1x, null, '1x');
            $question->saveFile($request->media_file_name_2x, null, '2x');
            $question->saveFile($request->media_file_name_3x, null, '3x');

            return $question;
        });

        return redirect(route('admin.quizzes.questions.edit', ['quiz' => $quiz->id, 'question' => $question->id]));
    }

    public function update(FunnelQuizQuestion $quiz, FunnelQuizQuestion $question, Request $request)
    {
        $request->validate([
            'type' => 'required|string|in:'.implode(',', FunnelQuizQuestionType::all()),
            'question' => 'required|min:1|max:255',
            'order' => 'required|int|min:1|max:255',
            'is_active' => 'boolean',
            'media_file_name_1x' => 'file|image',
            'media_file_name_2x' => 'file|image',
            'media_file_name_3x' => 'file|image',
        ]);

        DB::transaction(function () use ($request, $question) {
            $question->update([
                'type' => $request->type,
                'question' => $request->question,
                'order' => $request->order,
                'is_active' => (bool) $request->is_active,
            ]);

            $question->saveFile($request->media_file_name_1x, null, '1x');
            $question->saveFile($request->media_file_name_2x, null, '2x');
            $question->saveFile($request->media_file_name_3x, null, '3x');

            return $question;
        });

        $request->session()->flash('alert-success', 'Task was successful!');

        return back();
    }

    public function removeImage(FunnelQuizQuestion $quiz, FunnelQuizQuestion $question, $size)
    {
        $question->removeFile($size);

        return back();
    }
}
