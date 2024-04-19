@extends('admin.pages.funnel.edit')

@section('content_header')
    <h1>{{ trans('admin.page.tenants.seasons.game_hub.content_header.actions') }}</h1>
@endsection

@section('tab_content')
        <div class="card-body" >

            <livewire:admin.funnel.page :funnel="$funnel" />

        </div>
@endsection


