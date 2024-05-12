<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller as Controller;
use App\Http\Resources\API\v1\PostResource;
use App\Http\Resources\API\v1\PostViewResource;
use App\Http\Resources\API\v1\TagResource;
use App\Models\CMS\Post;
use App\Models\CMS\Tag;
use Illuminate\Http\Request;

class CMSController extends Controller
{
    public function tags()
    {
        return TagResource::collection(Tag::where('is_active', 1)->simplePaginate());
    }

    public function posts(Request $request)
    {
        $query = Post::query();

        if ($request->has('tag_id')) {
            $tagIds = $request->input('tag_id');

            $query->whereHas('tags', function ($query) use ($tagIds) {
                if (! is_array($tagIds)) {
                    $tagIds = [$tagIds];
                }

                $query->whereIn('post_tag.tag_id', $tagIds);
            });
        }

        $posts = $query->where('is_active', 1)->orderBy('position')->simplePaginate()->appends($request->all());

        return PostResource::collection($posts);
    }

    public function postView(Post $post)
    {
        if ($post->is_active === false) {
            abort(404);
        }

        return new PostViewResource($post);
    }
}
