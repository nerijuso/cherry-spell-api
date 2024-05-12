@extends('admin.layouts.main')

@section('page_head_title')
    <h1>{{ trans('admin.page.tags.content_header.edit') }} <i>{{$item->name}}</i></h1>
@endsection

@section('content')
    <div class="card container-tight">
        <form action="{{route('admin.cms.tags.update', ['tag' => $item->id])}}" method="POST" enctype="multipart/form-data">
            @method('POST')
            @csrf
            @include('admin.pages.cms.tag.form', ['submitButton' => trans('admin.button.update')])
        </form>
    </div>
@endsection
