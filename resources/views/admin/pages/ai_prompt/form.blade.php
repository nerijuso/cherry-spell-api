
<div class="card-body">
    <div class="alert alert-info">{{trans('admin.page.ai_prompt.content.alert_info')}}</div>


    <div class="form-group mb-3">
        <label for="title">{{ trans('admin.page.ai_prompt.form.identifier') }}</label>
        <input type="text" readonly disabled class="form-control" name="identifier" id="identifier" value="{{ $prompt?->id }}"/>
    </div>

    <div class="form-group mb-3">
        <label for="short_desc">{{ trans('admin.page.ai_prompt.form.short_desc') }}</label>
        <textarea class="form-control" rows="3" name="short_desc" id="short_desc" >{{ old('short_desc', $prompt?->short_desc) }}</textarea>
    </div>

    <div class="form-group mb-3">
        <label for="value">{{ trans('admin.page.ai_prompt.form.value') }}</label>
        <textarea class="form-control" rows="16" name="value" id="value" >{{ old('value', $prompt?->value) }}</textarea>
    </div>
</div>

<div class="card-footer">
    <div class="form-group ml-auto d-flex">
        <a href="{{route('admin.ai_prompts')}}" class="btn ml-0">{{  trans('admin.button.back') }}</a>
        <button type="submit" class="btn btn-primary ms-auto">{{ $submitButton }}</button>
    </div>
</div>

