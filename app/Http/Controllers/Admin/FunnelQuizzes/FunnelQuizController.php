<?php

namespace App\Http\Controllers\Admin\FunnelQuizzes;

use App\Http\Controllers\Controller;
use App\Models\FunnelQuiz\FunnelQuiz;
use Illuminate\Http\Request;

class FunnelQuizController extends Controller
{
    public function index(Request $request)
    {
        $query = FunnelQuiz::query();

        if ($request->has('title')) {
            $query->where('title', 'LIKE', '%'.$request->input('title').'%');
        }

        $items = $query->paginate(30)->appends($request->all());

        return view('admin.pages.quiz.index', ['items' => $items]);
    }

    public function create(FunnelQuiz $item)
    {
        return view('admin.pages.quiz.create', [
            'item' => $item,
        ]);
    }

    public function edit(FunnelQuiz $quiz)
    {
        return view('admin.pages.quiz.edit', [
            'item' => $quiz,
            'questions' => $quiz->questions()->orderBy('order')->get(),
        ]);
    }

    public function storeNew(FunnelQuiz $item, Request $request)
    {
        $request->validate([
            'title' => 'required|min:1|max:255',
            'description' => 'required|min:1|max:255',
            'is_public' => 'boolean',
        ]);

        $quiz = (new FunnelQuiz())->create([
            'title' => $request->title,
            'description' => $request->description,
            'is_published' => (bool) $request->is_public,
        ]);

        return redirect(route('admin.quizzes.edit', ['quiz' => $quiz->id]));
    }

    public function update(FunnelQuiz $quiz, Request $request)
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
