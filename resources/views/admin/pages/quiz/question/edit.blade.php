@extends('admin.layouts.main')

@section('page_head_title')
    <h1>{{ trans('admin.page.quiz.questions.content_header.edit_question') }} <i>{{$question->question}}</i></h1>
@endsection

@section('content')
    <div class="card container-tight mb-5">
        <form action="{{route('admin.quizzes.questions.update', ['quiz' => $quiz->id, 'question' => $question->id])}}" method="POST" enctype="multipart/form-data">
            @method('POST')
            @csrf
            @include('admin.pages.quiz.question.form', ['submitButton' => trans('admin.button.update')])
        </form>
    </div>
    <div class="card ">
        <div class="card-header">
            <h3 class="card-title">{{ trans('admin.page.quiz.content_header.question_options') }}</h3>
            <div class="col-auto ms-auto d-print-none">
                <div class="btn-list">
                    <div class="col-auto ms-auto d-print-none">
                        <div class="btn-list">
                            <a href="{{route('admin.quizzes.questions.options.create', ['quiz' => $quiz->id, 'question' => $question->id]) }}" class="btn btn-primary d-none d-sm-inline-block">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M12 5l0 14"></path><path d="M5 12l14 0"></path></svg>
                                {{ trans('admin.button.create') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card ">
            <div class="card-body">
                @if (!is_null($questionOptions) && $questionOptions->count() > 0)
                    <table class="table table-vcenter card-table">
                        <thead>
                        <tr>
                            <th>{{ trans('admin.page.quiz.questions.options.content.order') }}</th>
                            <th>{{ trans('admin.page.quiz.questions.options.content.option') }}</th>
                            <th>{{ trans('admin.page.quiz.questions.options.content.is_active') }}</th>
                            <th>{{ trans('admin.page.quiz.questions.options.content.created_at') }}</th>
                            <th>{{ trans('admin.page.quiz.questions.options.content.updated_at') }}</th>
                            <th class="w-1"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($questionOptions as $questionOption)
                            <tr>
                                <td class="text-secondary">
                                    {{$questionOption->order}}
                                </td>
                                <td class="text-secondary">
                                    {{$questionOption->option}}
                                </td>
                                <td nowrap>{{ $questionOption->is_active ? trans('admin.page.quiz.questions.content.yes') : trans('admin.page.quiz.questions.content.no') }}</td>
                                <td class="text-secondary">
                                    {{$questionOption->created_at}}
                                </td>
                                <td class="text-secondary">
                                    {{$questionOption->updated_at}}
                                </td>
                                <td>
                                    <a href="{{ route('admin.quizzes.questions.options.edit', ['quiz' => $quiz->id, 'question' => $question->id, 'option' => $questionOption->id]) }}">
                                        <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-edit"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" /><path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" /><path d="M16 5l3 3" /></svg>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @else
                    @include('admin.layouts.parts.no_items')
                @endif
            </div>
        </div>
    </div>
@endsection
