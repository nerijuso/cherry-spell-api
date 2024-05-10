
<div class="card-body">
    <div class="form-group mb-3">
        <label for="name">{{ trans('admin.page.tags.form.title') }}</label>
        <input type="text" class="form-control" name="name" id="name" value="{{ old('name', $item?->name) }}"/>
    </div>

    <div class="form-group mb-3">
        <label for="position">{{ trans('admin.page.tags.form.position') }}</label>
        <input type="text" class="form-control" name="position" id="position" value="{{ old('position', $item?->position) }}"/>
    </div>

    <div class="form-check mb-3">
        <input type="checkbox" value="1" class="form-check-input" name="is_active" id="is_active" @checked(old('is_active', $item?->is_active))/>
        <label for="is_public">{{ trans('admin.page.tags.form.is_active') }}</label>
    </div>
</div>

<div class="card-footer">
    <div class="form-group ml-auto d-flex">
        <a href="{{route('admin.cms.tags')}}" class="btn ml-0">{{  trans('admin.button.back') }}</a>
        <button type="submit" class="btn btn-primary ms-auto">{{ $submitButton }}</button>
    </div>
</div>

