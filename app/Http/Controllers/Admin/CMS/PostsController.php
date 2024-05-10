<?php

namespace App\Http\Controllers\Admin\CMS;

use App\Http\Controllers\Controller as Controller;
use App\Models\CMS\Post;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    public function index(Request $request)
    {
        $query = Post::query();

        if ($request->has('title')) {
            $query->where('title', 'LIKE', '%'.$request->input('title').'%');
        }

        $items = $query->paginate(30)->appends($request->all());

        return view('admin.pages.cms.post.index', [
            'items' => $items,
        ]);
    }

    public function create(Post $tag)
    {
        return view('admin.pages.cms.post.create', [
            'item' => $tag,
        ]);
    }

    public function edit(Post $tag)
    {
        return view('admin.pages.cms.post.edit', [
            'item' => $tag,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|min:1|max:255',
            'position' => 'required|integer',
            'is_active' => 'boolean',
        ]);

        $item = (new Post())->create([
            'title' => $request->title,
            'position' => $request->position,
            'is_active' => (bool) $request->is_active,
        ]);

        $request->session()->flash('alert-success', trans('admin.page.posts.messages.tag_created'));

        return redirect(route('admin.cms.posts.edit', ['post' => $item->id]));
    }

    public function update(Post $post, Request $request)
    {
        $request->validate([
            'title' => 'required|min:1|max:255',
            'position' => 'required|integer',
            'is_active' => 'boolean',
        ]);

        $post->update([
            'name' => $request->title,
            'position' => $request->position,
            'is_active' => (bool) $request->is_active,
        ]);

        $request->session()->flash('alert-success', trans('admin.page.posts.messages.tag_updated'));

        return back();
    }
}
