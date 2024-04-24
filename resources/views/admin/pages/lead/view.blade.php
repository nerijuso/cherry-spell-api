@extends('admin.layouts.main')

@section('page_head_title')
    <h1>{{ trans('admin.page.lead.content_header.view_lead') }} <i>{{$lead->email}}</i></h1>
@endsection

@section('content')
    <div class="card">
            <div class="card-table table-responsive">
                <table class="table">
                    <tbody>
                    <tr>
                        <td width="20%">{{ trans('admin.page.lead.content.id') }}</td>
                        <td>{{$lead->id}}</td>
                    </tr>
                    <tr>
                        <td>{{ trans('admin.page.lead.content.code') }}</td>
                        <td>{{$lead->code}}</td>
                    </tr>
                    <tr>
                        <td>{{ trans('admin.page.lead.content.email') }}</td>
                        <td>{{$lead->email}}</td>
                    </tr>
                    <tr>
                        <td>{{ trans('admin.page.lead.content.funnel') }}</td>
                        <td>
                            @if($lead->funnel_id)
                                <a href="{{route('admin.funnels.edit', $lead->funnel_id)}}">
                                    {{data_get( $lead->funnel, 'name', '-')}}
                                </a>
                            @else
                                -
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>{{ trans('admin.page.lead.content.country') }}</td>
                        <td>{{data_get( $lead->country, 'name', '-')}}</td>
                    </tr>
                    <tr>
                        <td>{{ trans('admin.page.lead.content.user') }}</td>
                        <td>
                            @if($lead->user_id)
                                <a href="{{route('admin.users.view', $lead->user_id)}}">
                                    {{$lead->user->name}} ({{trans('admin.page.lead.content.user_id') }}: {{$lead->user_id}})
                                </a>
                            @else
                                -
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>{{ trans('admin.page.lead.content.created_at') }}</td>
                        <td>{{$lead->created_at}}</td>
                    </tr>
                    <tr>
                        <td>{{ trans('admin.page.lead.content.updated_at') }}</td>
                        <td>{{$lead->updated_at}}</td>
                    </tr>
                    <tr>
                        <td>{{ trans('admin.page.lead.content.quiz_answers') }}</td>
                        <td>
                            @php
                                \Symfony\Component\VarDumper\VarDumper::dump($lead->quiz_answers);
                            @endphp
                    </tr>
                    </tbody>
                </table>
            </div>
    </div>
@endsection
