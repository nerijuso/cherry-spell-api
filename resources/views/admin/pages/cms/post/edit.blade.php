@extends('admin.layouts.main')

@section('page_head_title')
    <h1>{{ trans('admin.page.posts.content_header.edit') }} <i>{{$item->name}}</i></h1>
@endsection

@section('content')
    <div class="row">
        <div class="col-9">
            <div class="card">
                <form action="{{route('admin.cms.posts.update', ['post' => $item->id])}}" method="POST" enctype="multipart/form-data">
                    @method('POST')
                    @csrf
                    @include('admin.pages.cms.post.form', ['submitButton' => trans('admin.button.update')])
                </form>
            </div>
        </div>
        <div class="col-3">
            <div class="card">
                @include('admin.pages.cms.post.tags')
            </div>
        </div>
    </div>

@endsection
