
<div class="card-body">
    <div class="form-group mb-3">
        <label for="title">{{ trans('admin.page.quiz.form.title') }}</label>
        <input type="text" class="form-control" name="title" id="title" value="{{ old('title', $item?->title) }}"/>
    </div>

    <div class="form-group mb-3">
        <label for="description">{{ trans('admin.page.quiz.form.description') }}</label>
        <textarea class="form-control" rows="6" name="description" id="description" >{{ old('description', $item?->description) }}</textarea>
    </div>

    <div class="form-check mb-3">
        <input type="checkbox" value="1" class="form-check-input" name="is_public" id="is_public" @checked(old('is_public', $item?->is_published))/>
        <label for="is_public">{{ trans('admin.page.quiz.form.is_public') }}</label>
    </div>


</div>

<div class="card-footer">
    <div class="form-group ml-auto d-flex">
        <a href="{{route('admin.quizzes')}}" class="btn ml-0">{{  trans('admin.button.back') }}</a>
        <button type="submit" class="btn btn-primary ms-auto">{{ $submitButton }}</button>
    </div>
</div>

