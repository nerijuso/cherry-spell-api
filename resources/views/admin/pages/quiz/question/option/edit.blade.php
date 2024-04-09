@extends('admin.layouts.main')

@section('page_head_title')
    <h1>{{ trans('admin.page.quiz.questions.options.content_header.edit_option') }} <i>{{$option->option}}</i></h1>
@endsection

@section('content')
    <div class="card container-tight mb-5">
        <form action="{{route('admin.quizzes.questions.options.update', ['quiz' => $quiz->id, 'question' => $question->id, 'option' => $option->id])}}" method="POST" enctype="multipart/form-data">
            @method('POST')
            @csrf
            @include('admin.pages.quiz.question.option.form', ['submitButton' => trans('admin.button.update')])
        </form>
    </div>

@endsection
