<?php

namespace App\Http\Controllers\Admin\Quizzes;

use App\Http\Controllers\Controller;
use App\Models\Quiz\Topic;
use Illuminate\Http\Request;

class TopicController extends Controller
{
    public function index(Request $request)
    {
        $query = Topic::query();

        if ($request->has('name')) {
            $query->where('topic', 'LIKE', '%'.$request->input('name').'%');
        }

        $topics = $query->paginate(30)->appends($request->all());

        return view('admin.pages.quiz.topic.index', ['topics' => $topics]);
    }

    public function create(Topic $topic)
    {
        return view('admin.pages.quiz.topic.create', ['topic' => $topic]);
    }

    public function edit(Topic $topic)
    {
        return view('admin.pages.quiz.topic.edit', ['topic' => $topic]);
    }

    public function storeNew(Topic $topic, Request $request)
    {
        $request->validate([
            'id' => 'required|unique:topics|max:255',
            'topic' => 'required',
        ]);

        (new Topic())->updateOrCreate(['id' => $request->id], [
            'topic' => $request->topic,
        ]);

        return redirect(route('admin.quizzes.topics'));
    }

    public function update(Topic $topic, Request $request)
    {
        $request->validate([
            'topic' => 'required',
        ]);

        $topic->topic = $request->topic;
        $topic->save();

        return redirect(route('admin.quizzes.topics'));
    }
}
