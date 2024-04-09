@extends('admin.layouts.main')

@section('page_head_title')
    <h1>{{ trans('admin.page.quiz.topic.content_header.create') }}</h1>
@endsection

@section('content')
    <div class="card container-tight">
        <form action="{{route('admin.quizzes.topics.store')}}" method="POST">
            @method('POST')
            @csrf
            @include('admin.pages.quiz.topic.form', ['submitButton' => trans('admin.button.create')])
        </form>
    </div>
@endsection
