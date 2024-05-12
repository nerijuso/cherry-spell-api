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
        $images = [];

        foreach ((new Tag())->imageSizes as $size) {
            $images[$size] = 'sometimes|file|image';
        }

        $request->validate(array_merge([
            'name' => 'required|min:1|max:255',
            'position' => 'required|integer',
            'is_active' => 'boolean',
        ]));

        $item = (new Tag())->create([
            'name' => $request->name,
            'position' => $request->position,
            'is_active' => (bool) $request->is_active,
        ]);

        foreach ($item->imageSizes as $size) {
            $item->saveFile($request->{$size}, null, $size);
        }

        $request->session()->flash('alert-success', trans('admin.page.tags.messages.tag_created'));

        return redirect(route('admin.cms.tags.edit', ['tag' => $item->id]));
    }

    public function update(Tag $tag, Request $request)
    {
        $images = [];

        foreach ($tag->imageSizes as $size) {
            $images[$size] = 'sometimes|file|image';
        }

        $request->validate(array_merge([
            'name' => 'required|min:1|max:255',
            'position' => 'required|integer',
            'is_active' => 'boolean',
        ], $images));

        $tag->update([
            'name' => $request->name,
            'position' => $request->position,
            'is_active' => (bool) $request->is_active,
        ]);

        foreach ($tag->imageSizes as $size) {
            $tag->saveFile($request->{$size}, null, $size);
        }

        $request->session()->flash('alert-success', trans('admin.page.tags.messages.tag_updated'));

        return back();
    }

    public function removeImage(Tag $tag, $size)
    {
        $tag->removeFile($size);

        return back();
    }
}
