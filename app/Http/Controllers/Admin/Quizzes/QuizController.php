<?php

namespace App\Http\Controllers\Admin\Quizzes;

use App\Http\Controllers\Controller;
use App\Models\Quiz\Quiz;
use App\Models\Quiz\Topic;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    public function index(Request $request)
    {
        $query = Quiz::query();

        if ($request->has('title')) {
            $query->where('title', 'LIKE', '%'.$request->input('title').'%');
        }

        $items = $query->with('topic')->paginate(30)->appends($request->all());

        return view('admin.pages.quiz.index', ['items' => $items]);
    }

    public function create(Quiz $item)
    {
        return view('admin.pages.quiz.create', [
            'item' => $item,
            'topics' => Topic::all(),
        ]);
    }

    public function edit(Quiz $quiz)
    {
        return view('admin.pages.quiz.edit', [
            'item' => $quiz,
            'topics' => Topic::all(),
            'questions' => $quiz->questions()->orderBy('order')->get(),
        ]);
    }

    public function storeNew(Quiz $item, Request $request)
    {
        $request->validate([
            'topic_id' => 'required|unique:quizzes',
            'title' => 'required|min:1|max:255',
            'description' => 'required|min:1|max:255',
            'is_public' => 'boolean',
        ]);

        $quiz = (new Quiz())->create([
            'topic_id' => $request->topic_id,
            'title' => $request->title,
            'description' => $request->description,
            'is_published' => (bool) $request->is_public,
        ]);

        return redirect(route('admin.quizzes.edit', ['quiz' => $quiz->id]));
    }

    public function update(Quiz $quiz, Request $request)
    {
        $request->validate([
            'title' => 'required|min:1|max:255',
            'description' => 'required|min:1|max:255',
            'is_public' => 'boolean',
        ]);

        $quiz->update([
            'title' => $request->title,
            'description' => $request->description,
            'is_published' => (bool) $request->is_public,
        ]);

        $request->session()->flash('alert-success', 'Task was successful!');

        return back();
    }
}
