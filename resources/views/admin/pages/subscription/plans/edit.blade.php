@extends('admin.layouts.main')

@section('page_head_title')
    <h1>{{ trans('admin.page.subscription.content_header.edit') }} <i>{{$subscriptionPlan->name}}</i></h1>
@endsection

@section('content')
    <div class="card">
        <form action="{{route('admin.subscriptions.plans.update', ['subscriptionPlan' => $subscriptionPlan->id])}}" method="POST">
            @method('POST')
            @csrf
            @include('admin.pages.subscription.plans.form', ['submitButton' => trans('admin.button.update')])
        </form>
    </div>
@endsection
