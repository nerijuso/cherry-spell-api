@extends('admin.layouts.main')

@section('page_head_title')
    <h1>{{ trans('admin.page.funnel.content_header.create') }}</h1>
@endsection

@section('content')
    <div class="card">
        <form action="{{route('admin.funnels.store')}}" method="POST">
            @method('POST')
            @csrf
            @include('admin.pages.funnel.form', ['submitButton' => trans('admin.button.create')])
        </form>
    </div>
@endsection
