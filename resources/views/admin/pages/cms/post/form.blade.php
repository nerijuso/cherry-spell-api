
<div class="card-body">
    <div class="form-group mb-3">
        <label for="title">{{ trans('admin.page.posts.form.title') }}</label>
        <input type="text" class="form-control" name="title" id="title" value="{{ old('title', $item?->title) }}"/>
    </div>
<hr/>
    <div class="row mb-3">
        @foreach($item->imageSizes as $image)
            <div class="mb-3 col-sm-4">
                <div class="form-label">{{ trans('admin.page.tags.form.'.$image) }}</div>
                @if(is_null($item->getPublicMediaUrl($image)))
                    <input accept="image/png, image/jpeg" type="file" name="{{$image}}" class="form-control">
                @else
                    <div class="form-group mb-3">
                        {{ trans('admin.page.tags.form.remove_image') }}
                        <a href="{{route('admin.cms.tags.remove_image', ['tag' => $item->id, 'size' => $image])}}" class="btn btn-danger btn-xs" style="width:25px; margin:0; padding-left:25px; height: 25px" title="{{ trans('admin.button.remove_image') }}">
                            <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-photo-x"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M15 8h.01" /><path d="M13 21h-7a3 3 0 0 1 -3 -3v-12a3 3 0 0 1 3 -3h12a3 3 0 0 1 3 3v7" /><path d="M3 16l5 -5c.928 -.893 2.072 -.893 3 0l3 3" /><path d="M14 14l1 -1c.928 -.893 2.072 -.893 3 0" /><path d="M22 22l-5 -5" /><path d="M17 22l5 -5" /></svg>
                        </a>
                    </div>
                    <img src="{{$item->getPublicMediaUrl($image)}}" alt="" height="90" />
                @endif
            </div>
        @endforeach
    </div>
    <div class="form-group mb-3">
        <label for="text">{{ trans('admin.page.posts.form.content') }}</label>
        <textarea class="form-control" rows="30" name="text" id="text">{{ old('text', $item?->content) }}</textarea>
    </div>

    <div class="form-group mb-3">
        <label for="position">{{ trans('admin.page.posts.form.position') }}</label>
        <input type="text" class="form-control" name="position" id="position" value="{{ old('position', $item?->position) }}"/>
    </div>

    <div class="form-check mb-3">
        <input type="checkbox" value="1" class="form-check-input" name="is_active" id="is_active" @checked(old('is_active', $item?->is_active))/>
        <label for="is_active">{{ trans('admin.page.posts.form.is_active') }}</label>
    </div>
</div>

<div class="card-footer">
    <div class="form-group ml-auto d-flex">
        <a href="{{route('admin.cms.posts')}}" class="btn ml-0">{{  trans('admin.button.back') }}</a>
        <button type="submit" class="btn btn-primary ms-auto">{{ $submitButton }}</button>
    </div>
</div>
@push('footer_additional_js')
    @vite([ 'resources/js/tinyMCE.js' ])

    <script>

        document.addEventListener("DOMContentLoaded", function() {
            tinyMCE.baseURL = "/public/js/tinymce";// trailing slash important
            const imageUploadHandler = (blobInfo, progress) => new Promise((resolve, reject) => {
                const xhr = new XMLHttpRequest();
                xhr.withCredentials = false;
                xhr.open('POST', '{{route('admin.cms.tinymce.upload')}}');
                xhr.setRequestHeader("X-CSRF-Token", '{{ csrf_token() }}');

                xhr.upload.onprogress = (e) => {
                    progress(e.loaded / e.total * 100);
                };

                xhr.onload = () => {
                    if (xhr.status === 403) {
                        reject({ message: 'HTTP Error: ' + xhr.status, remove: true });
                        return;
                    }

                    const json = JSON.parse(xhr.responseText);

                    if (xhr.status !== 200) {
                        reject('Error: ' + json.error);
                        return;
                    }

                    if (!json || typeof json.location != 'string') {
                        reject('Invalid JSON: ' + xhr.responseText);
                        return;
                    }

                    resolve(json.location);
                };

                xhr.onerror = () => {
                    reject('Image upload failed due to a XHR Transport error. Code: ' + xhr.status);
                };

                const formData = new FormData();
                formData.append('file', blobInfo.blob(), blobInfo.filename());

                xhr.send(formData);
            });

            let options = {
                license_key: 'gpl',
                selector: '#content',
                height: 600,
                menubar: false,
                statusbar: true,
                plugins: [
                    'table', 'image', 'lists', 'link'
                ],

                content_css: false,
                skin: false,
                images_file_types: 'jpg,png',
                file_picker_types: 'image',
                automatic_uploads: true,
                images_upload_handler: imageUploadHandler,
                toolbar: 'undo redo | formatselect | image table link | ' +
                    'bold italic | alignleft aligncenter ' +
                    'alignright alignjustify | bullist numlist | ' +
                    'removeformat',
                content_style: 'body { font-family: -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif; font-size: 14px; -webkit-font-smoothing: antialiased; }'
             }

            tinyMCE.init(options);
        })
    </script>
@endpush
