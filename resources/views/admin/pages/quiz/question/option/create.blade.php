@extends('admin.layouts.main')

@section('page_head_title')
    <h1>{{ trans('admin.page.quiz.questions.options.content_header.create') }}</h1>
@endsection

@section('content')
    <div class="card container-tight">
        <form action="{{route('admin.quizzes.questions.options.store', ['quiz' => $quiz->id, 'question' => $item->id])}}" method="POST" enctype="multipart/form-data">
            @method('POST')
            @csrf
            @include('admin.pages.quiz.question.option.form', ['quiz' => $quiz, 'question' => $item, 'submitButton' => trans('admin.button.create')])
        </form>
    </div>
@endsection
