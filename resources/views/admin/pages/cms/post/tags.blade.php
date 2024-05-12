<div class="card-header">
    Tags
</div>
<div class="card-body">
    @if (is_null($item->id))
        <div class="alert alert-info">
            {{ trans('admin.page.posts.form.tags_alert') }}
        </div>
    @else
        <livewire:admin.cms.post-tags :post="$item"/>
    @endif

</div>
