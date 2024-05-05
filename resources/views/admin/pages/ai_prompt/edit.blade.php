@extends('admin.layouts.main')

@section('page_head_title')
    <h1>{{ trans('admin.page.ai_prompt.content_header.ai_prompt') }} <i>{{$prompt->id}}</i></h1>
@endsection

@section('content')
    <div class="card container mb-5">
        <form action="{{route('admin.ai_prompts.update', ['prompt' => $prompt->id])}}" method="POST">
            @method('POST')
            @csrf
            @include('admin.pages.ai_prompt.form', ['submitButton' => trans('admin.button.update')])
        </form>
    </div>
@endsection
