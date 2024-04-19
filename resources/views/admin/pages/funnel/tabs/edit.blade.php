@extends('admin.pages.funnel.edit')

@section('content_header')
    <h1>{{ trans('admin.page.tenants.seasons.game_hub.content_header.actions') }}</h1>
@endsection

@section('tab_content')
    <div class="box">
        <div class="box-body">
            <form action="{{route('admin.funnels.update', ['funnel' => $funnel->id])}}" method="POST">
                @method('POST')
                @csrf
                @include('admin.pages.funnel.form', ['submitButton' => trans('admin.button.update')])
            </form>
        </div>
    </div>
@endsection


