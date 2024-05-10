<?php

namespace App\Http\Controllers\Admin\CMS;

use App\Http\Controllers\Controller as Controller;
use App\Models\CMS\Tag;
use Illuminate\Http\Request;

class TagsController extends Controller
{
    public function index(Request $request)
    {
        $query = Tag::query();

        if ($request->has('name')) {
            $query->where('name', 'LIKE', '%'.$request->input('name').'%');
        }

        $items = $query->paginate(30)->appends($request->all());

        return view('admin.pages.cms.tag.index', [
            'items' => $items,
        ]);
    }

    public function create(Tag $tag)
    {
        return view('admin.pages.cms.tag.create', [
            'item' => $tag,
        ]);
    }

    public function edit(Tag $tag)
    {
        return view('admin.pages.cms.tag.edit', [
            'item' => $tag,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:1|max:255',
            'position' => 'required|integer',
            'is_active' => 'boolean',
        ]);

        $item = (new Tag())->create([
            'name' => $request->name,
            'position' => $request->position,
            'is_active' => (bool) $request->is_active,
        ]);

        $request->session()->flash('alert-success', trans('admin.page.tags.messages.tag_created'));

        return redirect(route('admin.cms.tags.edit', ['tag' => $item->id]));
    }

    public function update(Tag $tag, Request $request)
    {
        $request->validate([
            'name' => 'required|min:1|max:255',
            'position' => 'required|integer',
            'is_active' => 'boolean',
        ]);

        $tag->update([
            'name' => $request->name,
            'position' => $request->position,
            'is_active' => (bool) $request->is_active,
        ]);

        $request->session()->flash('alert-success', trans('admin.page.tags.messages.tag_updated'));

        return back();
    }
}
