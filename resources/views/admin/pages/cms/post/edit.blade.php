@extends('admin.pages.tenants.edit_layout')

@section('content_header')
    <h1>{{ trans('admin.page.posts.content_header.edit') }}</h1>
@endsection

@section('tab_content')
    {{ Form::model($item, ['url' => route('admin.tenants.articles.update', ['article' => $article->id, 'tenant' => $tenant->id]), 'method' => 'POST', 'class' => 'jsonForm']) }}
        @include('admin.pages.articles.form', ['submitButton' => trans('admin.button.update')])
    {{ Form::close() }}
@endsection


