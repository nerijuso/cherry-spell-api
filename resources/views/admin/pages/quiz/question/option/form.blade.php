
<div class="card-body">
    <div class="form-group mb-3">
        <label for="option">{{ trans('admin.page.quiz.questions.options.form.option') }}</label>
        <input type="text" class="form-control" name="option" id="option" value="{{ old('option', $option?->option) }}"/>
    </div>

    <div class="form-group mb-3">
        <label for="order">{{ trans('admin.page.quiz.questions.options.form.order') }}</label>
        <input type="text" class="form-control" name="order" id="order" value="{{ old('order', $option?->order) }}"/>
    </div>

    <div class="form-check mb-3">
        <input type="checkbox" value="1" class="form-check-input" name="is_active" id="is_active" @checked(old('is_active', $option?->is_active))/>
        <label for="is_public">{{ trans('admin.page.quiz.questions.options.form.is_active') }}</label>
    </div>

    <div class="mb-3">
        <div class="form-label">Icon 1x</div>
        @if(is_null($option->media_file_name_1x))
            <input accept="image/png, image/jpeg" type="file" name="media_file_name_1x" class="form-control">
        @else
            <div class="form-group">
                {{ trans('admin.page.quiz.questions.form.remove_image') }}
                <a href="{{route('admin.quizzes.questions.options.remove_image', ['quiz' => $quiz->id, 'question' => $question->id, 'option' => $option->id, 'size' => '1x'])}}" class="btn btn-danger btn-xs" style="width:25px; margin:0; padding-left:25px; height: 25px" title="{{ trans('admin.button.remove_image') }}">
                    <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-photo-x"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M15 8h.01" /><path d="M13 21h-7a3 3 0 0 1 -3 -3v-12a3 3 0 0 1 3 -3h12a3 3 0 0 1 3 3v7" /><path d="M3 16l5 -5c.928 -.893 2.072 -.893 3 0l3 3" /><path d="M14 14l1 -1c.928 -.893 2.072 -.893 3 0" /><path d="M22 22l-5 -5" /><path d="M17 22l5 -5" /></svg>
                </a>
            </div>
            <img src="{{$option->public_media_url_1x}}" alt="" height="50" />
        @endif
    </div>

    <div class="mb-3">
        <div class="form-label">Icon 2x</div>
        @if(is_null($option->media_file_name_2x))
            <input accept="image/png, image/jpeg" type="file" name="media_file_name_2x" class="form-control">
        @else
            <div class="form-group">
                {{ trans('admin.page.quiz.questions.form.remove_image') }}
                <a href="{{route('admin.quizzes.questions.options.remove_image', ['quiz' => $quiz->id, 'question' => $question->id, 'option' => $option->id, 'size' => '2x'])}}" class="btn btn-danger btn-xs" style="width:25px; margin:0; padding-left:25px; height: 25px" title="{{ trans('admin.button.remove_image') }}">
                    <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-photo-x"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M15 8h.01" /><path d="M13 21h-7a3 3 0 0 1 -3 -3v-12a3 3 0 0 1 3 -3h12a3 3 0 0 1 3 3v7" /><path d="M3 16l5 -5c.928 -.893 2.072 -.893 3 0l3 3" /><path d="M14 14l1 -1c.928 -.893 2.072 -.893 3 0" /><path d="M22 22l-5 -5" /><path d="M17 22l5 -5" /></svg>
                </a>
            </div>
            <img src="{{$option->public_media_url_2x}}" alt="" height="50" />
        @endif
    </div>

    <div class="mb-3">
        <div class="form-label">Icon</div>
        @if(is_null($option->media_file_name_3x))
            <input accept="image/png, image/jpeg" type="file" name="media_file_name_3x" class="form-control">
        @else
            <div class="form-group">
                {{ trans('admin.page.quiz.questions.form.remove_image') }}
                <a href="{{route('admin.quizzes.questions.options.remove_image', ['quiz' => $quiz->id, 'question' => $question->id, 'option' => $option->id, 'size' => '3x'])}}" class="btn btn-danger btn-xs" style="width:25px; margin:0; padding-left:25px; height: 25px" title="{{ trans('admin.button.remove_image') }}">
                    <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-photo-x"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M15 8h.01" /><path d="M13 21h-7a3 3 0 0 1 -3 -3v-12a3 3 0 0 1 3 -3h12a3 3 0 0 1 3 3v7" /><path d="M3 16l5 -5c.928 -.893 2.072 -.893 3 0l3 3" /><path d="M14 14l1 -1c.928 -.893 2.072 -.893 3 0" /><path d="M22 22l-5 -5" /><path d="M17 22l5 -5" /></svg>
                </a>
            </div>
            <img src="{{$option->public_media_url_3x}}" alt="" height="50" />
        @endif
    </div>
</div>

<div class="card-footer">
    <div class="form-group ml-auto d-flex">
        <a href="{{route('admin.quizzes.questions.edit', ['quiz' => $quiz->id, 'question' => $question->id])}}" class="btn ml-0">{{  trans('admin.button.back') }}</a>
        <button type="submit" class="btn btn-primary ms-auto">{{ $submitButton }}</button>
    </div>
</div>

