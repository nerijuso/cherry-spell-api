@extends('admin.layouts.main')

@section('page_head_title')
    <h1>{{ trans('admin.page.funnel.content_header.edit_funnel') }} <i>{{$funnel->name}}</i></h1>
@endsection

@section('content')
    <div class="card mb-5">
        <div class="card-header">
            <ul class="nav nav-tabs card-header-tabs" data-bs-toggle="tabs">
                <li class="nav-item">
                    <a  class="nav-link @if(Route::currentRouteName() === 'admin.funnels.edit') active @endif" href="{{ route('admin.funnels.edit', $funnel->id) }}">{{ trans('admin.page.funnel.buttons.edit') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if(Route::currentRouteName() === 'admin.funnels.pages') active @endif"
                        href="{{ route('admin.funnels.pages', $funnel->id) }}">{{ trans('admin.page.funnel.buttons.pages') }}</a>
                </li>
            </ul>
        </div>

        <div class="tab-content">
            <div class="tab-pane active" id="tab_1">
                @yield('tab_content')
            </div>
        </div>
    </div>
@endsection
