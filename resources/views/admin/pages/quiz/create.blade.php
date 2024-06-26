@extends('admin.layouts.main')

@section('page_head_title')
    <h1>{{ trans('admin.page.quiz.content_header.create_new') }}</h1>
@endsection

@section('content')
    <div class="card container-tight">
        <form action="{{route('admin.cms.tags.store')}}" method="POST">
            @method('POST')
            @csrf
            @include('admin.pages.cms.tag.form', ['submitButton' => trans('admin.button.create')])
        </form>
    </div>
@endsection
