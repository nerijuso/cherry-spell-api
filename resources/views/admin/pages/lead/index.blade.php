@extends('admin.layouts.main')

@section('page_head_title')
    <h1>{{ trans('admin.page.lead.content_header.leads') }}</h1>
@endsection

@section('content')
    <div class="box">
        <div class="box-header">
            <form name="filter" action="{{ route('admin.leads') }}" method="GET">
                <div class="row mb-3">
                    <div class="col-lg-4 col-md-3">
                        <div class="form-group">
                            <input type="text" name="email" value="{{request('email')}}" class="form-control" placeholder="{{ trans('admin.page.lead.buttons.email_placeholder') }}" aria-label="{{ trans('admin.page.lead.buttons.email_placeholder') }}">
                        </div>
                    </div>

                    <div class="col-lg-1 col-md-3 ">
                        <button type="submit" class="btn btn-md btn-default btn-flat btn-block">{{ trans('admin.page.lead.buttons.email') }}</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="box-body table-responsive">
            @if(!is_null($items) && $items->total() > 0)
                <div class="card">
                    <table class="table table-hover">
                        <tr>
                            <th nowrap>{{ trans('admin.page.lead.content.id') }}</th>
                            <th nowrap>{{ trans('admin.page.lead.content.code') }}</th>
                            <th nowrap>{{ trans('admin.page.lead.content.email') }}</th>
                            <th nowrap>{{ trans('admin.page.lead.content.created_at') }}</th>
                            <th nowrap></th>
                        </tr>
                        @foreach($items as $item)
                            <tr>
                                <td nowrap>{{ $item->id }}</td>
                                <td nowrap>{{ $item->code }}</td>
                                <td nowrap>{{ $item->email }}</td>
                                <td nowrap>{{ $item->created_at }}</td>
                                <td class="text-right">
                                    <a href="{{ route('admin.leads.view', $item->id) }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-eye"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0"></path><path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6"></path></svg>                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            @else
                @include('admin.layouts.parts.no_items')
            @endif
        </div>
        <div class="box-footer mt-4">
            {{ $items->render() }}
        </div>
    </div>
@endsection
