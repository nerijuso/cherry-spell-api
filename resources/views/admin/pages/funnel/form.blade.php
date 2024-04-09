
<div class="card-body">

    <div class="form-group mb-3">
        <label for="name">{{ trans('admin.page.funnel.form.name') }}</label>
        <input type="text" class="form-control" name="name" id="name" value="{{ old('name', $item?->name) }}"/>
    </div>

    <div class="form-group mb-3">
        <label for="quiz_id">{{ trans('admin.page.funnel.form.quizzes') }}</label>
        <select class="form-control" name="quiz_id" id="quiz_id">
            @foreach ($quizzes as $quiz)
                <option value="{{ $quiz->id }}" @selected(old('topic_id', $item?->quiz_id == $quiz->id))">
                {{ $quiz->title }}
                </option>
            @endforeach
        </select>
    </div>


    <div class="form-group mb-3">
        <label for="configuration">{{ trans('admin.page.funnel.form.configuration') }}</label>
        <textarea class="form-control" rows="20" name="configuration" id="configuration" >{{ old('configuration', $item?->configuration) }}</textarea>
    </div>

    <div class="form-check mb-3">
        <input type="checkbox" value="1" class="form-check-input" name="is_active" id="is_active" @checked(old('is_active', $item?->is_active))/>
        <label for="is_active">{{ trans('admin.page.funnel.form.is_active') }}</label>
    </div>

</div>

<div class="card-footer">
    <div class="form-group ml-auto d-flex">
        <a href="{{route('admin.funnels')}}" class="btn ml-0">{{  trans('admin.button.back') }}</a>
        <button type="submit" class="btn btn-primary ms-auto">{{ $submitButton }}</button>
    </div>
</div>

