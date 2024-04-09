@extends('admin.layouts.main')

@section('page_head_title')
    <h1>{{ trans('admin.page.funnel.content_header.edit_funnel') }} <i>{{$item->name}}</i></h1>
@endsection

@section('content')
    <div class="card mb-5">
        <form action="{{route('admin.funnels.update', ['funnel' => $item->id])}}" method="POST">
            @method('POST')
            @csrf
            @include('admin.pages.funnel.form', ['submitButton' => trans('admin.button.update')])
        </form>
    </div>
@endsection
