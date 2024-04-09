
<div class="card-body">
    <div class="form-group mb-3">
        <label for="type">{{ trans('admin.page.quiz.questions.form.types') }}</label>
        <select class="form-control" name="type" id="type">
            @foreach ($types as $type)
                <option value="{{ $type }}" @selected(old('type', $question->type) == $type)>
                    {{ $type }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="form-group mb-3">
        <label for="question">{{ trans('admin.page.quiz.questions.form.question') }}</label>
        <input type="text" class="form-control" name="question" id="question" value="{{ old('question', $question?->question) }}"/>
    </div>

    <div class="form-group mb-3">
        <label for="order">{{ trans('admin.page.quiz.questions.form.order') }}</label>
        <input type="text" class="form-control" name="order" id="order" value="{{ old('order', $question?->order) }}"/>
    </div>

    <div class="form-check mb-3">
        <input type="checkbox" value="1" class="form-check-input" name="is_active" id="is_active" @checked(old('is_active', $question?->is_active))/>
        <label for="is_public">{{ trans('admin.page.quiz.questions.form.is_active') }}</label>
    </div>

    <div class="mb-3">
        <div class="form-label">Icon</div>

        @if(is_null($question->media_file_name))
            <input type="file" name="file" class="form-control">
        @else
            <div class="form-group">
                {{ trans('admin.page.quiz.questions.form.remove_image') }}
                <a href="{{route('admin.quizzes.questions.remove_image', ['quiz' => $quiz->id, 'question' => $question->id])}}" class="btn btn-danger btn-xs" style="width:25px; margin:0; padding-left:25px; height: 25px" title="{{ trans('admin.button.remove_image') }}">
                    <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-photo-x"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M15 8h.01" /><path d="M13 21h-7a3 3 0 0 1 -3 -3v-12a3 3 0 0 1 3 -3h12a3 3 0 0 1 3 3v7" /><path d="M3 16l5 -5c.928 -.893 2.072 -.893 3 0l3 3" /><path d="M14 14l1 -1c.928 -.893 2.072 -.893 3 0" /><path d="M22 22l-5 -5" /><path d="M17 22l5 -5" /></svg>
                </a>
            </div>
            <img src="{{$question->public_media_url}}" alt="" height="50" />
        @endif
    </div>
</div>

<div class="card-footer">
    <div class="form-group ml-auto d-flex">
        <a href="{{route('admin.quizzes.edit', ['quiz' => $quiz->id])}}" class="btn ml-0">{{  trans('admin.button.back') }}</a>
        <button type="submit" class="btn btn-primary ms-auto">{{ $submitButton }}</button>
    </div>
</div>

