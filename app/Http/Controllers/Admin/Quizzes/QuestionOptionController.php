<?php

namespace App\Http\Controllers\Admin\Quizzes;

use App\Http\Controllers\Controller;
use App\Models\Quiz\Question;
use App\Models\Quiz\QuestionOption;
use App\Models\Quiz\Quiz;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QuestionOptionController extends Controller
{
    public function create(Quiz $quiz, Question $question, QuestionOption $option)
    {
        return view('admin.pages.quiz.question.option.create', [
            'quiz' => $quiz,
            'item' => $question,
            'option' => $option,
        ]);
    }

    public function edit(Quiz $quiz, Question $question, QuestionOption $option)
    {
        return view('admin.pages.quiz.question.option.edit', [
            'question' => $question,
            'quiz' => $quiz,
            'option' => $option,
        ]);
    }

    public function storeNew(Quiz $quiz, Question $question, Request $request)
    {
        $request->validate([
            'option' => 'required|min:1|max:255',
            'order' => 'required|int|min:1|max:255',
            'is_active' => 'boolean',
            'file' => 'file|image',
        ]);

        DB::transaction(function () use ($request, $question) {
            $questionOption = (new QuestionOption())->create([
                'question_id' => $question->id,
                'option' => $request->option,
                'order' => $request->order,
                'is_active' => (bool) $request->is_active,
            ]);
            $questionOption->saveFile($request->file);

            return $questionOption;
        });

        return redirect(route('admin.quizzes.questions.edit', ['quiz' => $quiz->id, 'question' => $question->id]));
    }

    public function update(Question $quiz, Question $question, QuestionOption $option, Request $request)
    {
        $request->validate([
            'option' => 'required|min:1|max:255',
            'order' => 'required|int|min:1|max:255',
            'is_active' => 'boolean',
            'file' => 'file|image',
        ]);

        DB::transaction(function () use ($request, $option) {
            $option->update([
                'option' => $request->option,
                'order' => $request->order,
                'is_active' => (bool) $request->is_active,
            ]);

            $option->saveFile($request->file);

            return $option;
        });

        $request->session()->flash('alert-success', 'Task was successful!');

        return redirect(route('admin.quizzes.questions.edit', ['quiz' => $quiz->id, 'question' => $question->id]));
    }

    public function removeImage(Quiz $quiz, Question $question, QuestionOption $option)
    {
        $option->removeFile();

        return back();
    }
}
