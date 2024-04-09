
<div class="card-body">
    <div class="form-group mb-3">
        <label for="id">Unique topic ID</label>
        <input type="text" class="form-control {{!is_null($topic?->id)? 'disabled' :''}}" name="id" id="id" value="{{ old('id', $topic?->id) }}" @disabled(!is_null($topic?->id))/>
    </div>

    <div class="form-group mb-3">
        <label for="name">Name</label>
        <input type="text" class="form-control" name="topic" id="name" value="{{ old('topic', $topic?->topic) }}"/>
    </div>
</div>

<div class="card-footer">
    <div class="form-group ml-auto d-flex">
        <a href="{{route('admin.quizzes.topics')}}" class="btn ml-0">{{  trans('admin.button.back') }}</a>
        <button type="submit" class="btn btn-primary ms-auto">{{ $submitButton }}</button>
    </div>
</div>

