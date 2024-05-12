<?php

namespace App\Livewire\Admin\CMS;

use App\Models\CMS\Post;
use App\Models\CMS\Tag;
use Livewire\Component;

class PostTags extends Component
{
    public $selectedTags = [];

    public Post $post;

    public function mount()
    {
        $this->selectedTags = $this->post->tags()->where('is_active', 1)->pluck('id')->values()->all();
    }

    public function render()
    {
        return view('livewire.admin.cms.post-tags')->with([
            'tags' => Tag::where('is_active', true)->get(),
        ]);
    }

    public function toggleTag($id): void
    {
        $tag = Tag::find($id);
        if (in_array($id, $this->selectedTags)) {
            $key = array_search($id, $this->selectedTags);
            unset($this->selectedTags[$key]);
            $tag->decrementPostCount();
        } else {
            $this->selectedTags[] = $id;
            $tag->incrementPostCount();
        }

        $this->post->tags()->sync($this->selectedTags);
    }
}
