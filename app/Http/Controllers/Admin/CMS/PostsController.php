<?php

namespace App\Http\Controllers\Admin\CMS;

use App\Http\Controllers\Controller as Controller;
use App\Http\Requests\Admin\CMS\SavePostRequest;
use App\Models\CMS\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

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

    public function edit(Post $post)
    {
        return view('admin.pages.cms.post.edit', [
            'item' => $post,
        ]);
    }

    public function store(SavePostRequest $request)
    {
        $item = (new Post())->create([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'content' => $request->text,
            'position' => $request->position,
            'is_active' => (bool) $request->is_active,
        ]);

        foreach ($item->imageSizes as $size) {
            $item->saveFile($request->{$size}, null, $size);
        }

        $request->session()->flash('alert-success', trans('admin.page.posts.messages.post_created'));

        return redirect(route('admin.cms.posts.edit', ['post' => $item->id]));
    }

    public function update(Post $post, SavePostRequest $request)
    {
        $post->update([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'content' => $request->text,
            'position' => $request->position,
            'is_active' => (bool) $request->is_active,
        ]);

        $request->session()->flash('alert-success', trans('admin.page.posts.messages.post_updated'));

        return back();
    }

    public function removeImage(Post $post, $size)
    {
        $post->removeFile($size);

        return back();
    }
}
