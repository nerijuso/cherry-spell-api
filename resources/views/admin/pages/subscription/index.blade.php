@extends('admin.layouts.main')

@section('page_head_title')
    <h1>{{ trans('admin.page.subscription.content_header.subscriptions') }}</h1>
@endsection

@section('content')
    <div class="box">
        <div class="box-body table-responsive">
            @if(!is_null($items) && $items->total() > 0)
                <div class="card">
                    <table class="table table-hover">
                        <tr>
                            <th nowrap>{{ trans('admin.page.subscription.content.id') }}</th>
                            <th nowrap>{{ trans('admin.page.subscription.content.user') }}</th>
                            <th nowrap>{{ trans('admin.page.subscription.content.is_active') }}</th>
                            <th nowrap>{{ trans('admin.page.subscription.content.created_at') }}</th>
                            <th nowrap></th>
                        </tr>
                        @foreach($items as $item)
                            <tr>
                                <td nowrap>{{ $item->id }}</td>
                                <td nowrap><a href="{{route('admin.users', $item->user_id)}}">{{ $item->user->name }}</a> </td>
                                <td nowrap>{{ $item->valid() ? trans('admin.page.subscription.content.yes') : trans('admin.page.subscription.content.no') }}</td>
                                <td nowrap>{{ $item->created_at }}</td>
                                <td class="text-right">
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
