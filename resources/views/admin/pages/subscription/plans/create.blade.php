@extends('admin.layouts.main')

@section('page_head_title')
    <h1>{{ trans('admin.page.subscription.content_header.create') }}</h1>
@endsection

@section('content')
    <div class="card">
        <form action="{{route('admin.subscriptions.plans.store')}}" method="POST" enctype="multipart/form-data">
            @method('POST')
            @csrf
            @include('admin.pages.subscription.plans.form', ['submitButton' => trans('admin.button.create')])
        </form>
    </div>
@endsection
