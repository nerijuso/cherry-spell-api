<?php

namespace App\Http\Controllers\Admin\Quizzes;

use App\Http\Controllers\Controller;
use App\Models\Enums\QuizQuestionType;
use App\Models\Quiz\Question;
use App\Models\Quiz\QuestionOption;
use App\Models\Quiz\Quiz;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QuestionController extends Controller
{
    public function create(Quiz $quiz, Question $question)
    {
        return view('admin.pages.quiz.question.create', [
            'quiz' => $quiz,
            'item' => $question,
            'types' => QuizQuestionType::all(),
        ]);
    }

    public function edit(Quiz $quiz, Question $question)
    {
        return view('admin.pages.quiz.question.edit', [
            'question' => $question,
            'quiz' => $quiz,
            'types' => QuizQuestionType::all(),
            'questionOptions' => QuestionOption::where('question_id', $question->id)->orderBy('order')->get(),
        ]);
    }

    public function storeNew(Quiz $quiz, Request $request)
    {
        $request->validate([
            'type' => 'required|string|in:'.implode(',', QuizQuestionType::all()),
            'question' => 'required|min:1|max:255',
            'order' => 'required|int|min:1|max:255',
            'is_active' => 'boolean',
            'file' => 'file|image',
        ]);

        $question = DB::transaction(function () use ($request, $quiz) {
            $question = (new Question())->create([
                'type' => $request->type,
                'quiz_id' => $quiz->id,
                'question' => $request->question,
                'order' => $request->order,
                'is_active' => (bool) $request->is_active,
            ]);
            $question->saveFile($request->file);

            return $question;
        });

        return redirect(route('admin.quizzes.questions.edit', ['quiz' => $quiz->id, 'question' => $question->id]));
    }

    public function update(Question $quiz, Question $question, Request $request)
    {
        $request->validate([
            'type' => 'required|string|in:'.implode(',', QuizQuestionType::all()),
            'question' => 'required|min:1|max:255',
            'order' => 'required|int|min:1|max:255',
            'is_active' => 'boolean',
            'file' => 'file|image',
        ]);

        DB::transaction(function () use ($request, $question) {
            $question->update([
                'type' => $request->type,
                'question' => $request->question,
                'order' => $request->order,
                'is_active' => (bool) $request->is_active,
            ]);

            $question->saveFile($request->file);

            return $question;
        });

        $request->session()->flash('alert-success', 'Task was successful!');

        return back();
    }

    public function removeImage(Question $quiz, Question $question)
    {
        $question->removeFile();

        return back();
    }
}
