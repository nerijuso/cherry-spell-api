<div class="tags-list">
@foreach($tags as $tag)
    <label class="tag fs-5 p-3 cursor-pointer">
        <input wire:click="toggleTag({{$tag->id}})" type="checkbox" class="form-check-input @if(in_array($tag->id, $selectedTags)) tag-check @endif" value="{{$tag->id}}" @checked(in_array($tag->id, $selectedTags))>
       {{$tag->name}}
    </label>
@endforeach
</div>
