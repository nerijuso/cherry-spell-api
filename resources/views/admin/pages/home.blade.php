@extends('admin.layouts.main')

@section('content')
    @section('page_head_pretitle')
        OVERVIEW
    @endsection
    @section('page_head_title')
        Dashboard
    @endsection
    <div class="row row-cards">
        <div class="col-sm-6 col-lg-3">
            <livewire:admin.dashboard.subscriptions-count />
        </div>
        <div class="col-sm-6 col-lg-3">
            <livewire:admin.dashboard.users-count />
        </div>
        <div class="col-sm-6 col-lg-3">
            <livewire:admin.dashboard.qr-codes-count />
        </div>
        <div class="col-sm-6 col-lg-3">
            <livewire:admin.dashboard.qr-codes-type-count />
        </div>
        <div class="col-lg-12">
            <livewire:admin.dashboard.users-by-day />
        </div>
        <div class="col-lg-12">
            <livewire:admin.dashboard.qr-scans-by-day />
        </div>
    </div>
    @livewireChartsScripts
@endsection
