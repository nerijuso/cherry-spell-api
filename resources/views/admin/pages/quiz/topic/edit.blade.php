@extends('admin.layouts.main')

@section('page_head_title')
    <h1>Edit topic <i>{{$topic->topic}}</i></h1>
@endsection

@section('content')
    <div class="card container-tight">
        <form action="{{route('admin.quizzes.topics.update', ['topic' => $topic->id])}}" method="POST">
            @method('POST')
            @csrf
            @include('admin.pages.quiz.topic.form', ['submitButton' => trans('admin.button.update')])
        </form>
    </div>
@endsection
