@extends('admin.layouts.main')

@section('page_head_title')
    <h1>{{ trans('admin.page.file_manager.content_header.file_manager') }}</h1>
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <form action="{{ route('admin.system.file_manager') }}" method="get">
                <label class="mb-2" for="folder"><strong>{{ trans('admin.page.file_manager.content.current_path') }}</strong></label>
                <div class="input-group input-group-sm">
                    <span class="input-group-btn">
                        <a title="{{ trans('admin.page.file_manager.content.backwards') }}" href="{{ route('admin.system.file_manager') . '?folder=' . $back }}" class="btn btn-default btn-flat">
                           <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon m-auto icon-tabler icons-tabler-outline icon-tabler-corner-down-left-double"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M19 5v6a3 3 0 0 1 -3 3h-7" /><path d="M13 10l-4 4l4 4m-5 -8l-4 4l4 4" /></svg>
                        </a>
                    </span>

                    <input id="folder" type="text" value="{{ request('folder') }}" name="folder" class="form-control"/>

                    <span class="input-group-btn align-center text-center">
                        <a title="{{ trans('admin.page.file_manager.content.upload') }}" href="javascript:;" class="btn btn-info btn-flat align-center " data-bs-toggle="modal" data-bs-target="#uploadModal">
                           <svg  xmlns="http://www.w3.org/2000/svg"   width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon m-auto icon-tabler icons-tabler-outline icon-tabler-upload"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 17v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2 -2v-2" /><path d="M7 9l5 -5l5 5" /><path d="M12 4l0 12" /></svg>
                        </a>
                    </span>
                </div>
            </form>
        </div>

        <div class="card-body">
            <ul class="list-group list-group-flush">
                @foreach($folders as $folder)
                    <li class="list-group-item list-group-item-action">
                        <i class="fa fa-folder pr-10 pt-5 pb-6 pl-5" aria-hidden="true"></i><a href="{{ route('admin.system.file_manager') }}?folder={{$folder}}">{{ $folder }}</a>
                    </li>
                @endforeach
            </ul>
            <ul class="list-group list-group-flush">
                @foreach($files as $file)
                    <li class="list-group-item list-group-item-action">
                        <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-folder"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 4h4l3 3h7a2 2 0 0 1 2 2v8a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-11a2 2 0 0 1 2 -2" /></svg>
                        <a target="_blank" href="{{ \Illuminate\Support\Facades\Storage::url($file) }}">{{ $file }}</a>

                        <a class="text-danger" onclick="return confirm('{{trans('admin.page.file_manager.content.confirm_remove', ['file' => $file])}}')" href="{{route('admin.system.file_manager.delete')}}?file={{$file}}">
                            <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-trash"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7l16 0" /><path d="M10 11l0 6" /><path d="M14 11l0 6" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg>
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>

    @include('admin.pages.file_manager.modals.upload_file')
@endsection
