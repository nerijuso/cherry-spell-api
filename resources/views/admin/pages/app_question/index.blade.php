@extends('admin.layouts.main')

@section('page_head_title')
    <h1>{{ trans('admin.page.app_question.content_header.app_questions') }}</h1>
@endsection

@section('content')
    <div class="box">
        <div class="box-body table-responsive">
            @if(!is_null($items) && $items->count() > 0)
                <div class="card">
                    <table class="table table-hover">
                        <tr>
                            <th nowrap>{{ trans('admin.page.app_question.content.id') }}</th>
                            <th nowrap>{{ trans('admin.page.app_question.content.question') }}</th>
                            <th nowrap>{{ trans('admin.page.app_question.content.is_active') }}</th>
                            <th nowrap>{{ trans('admin.page.app_question.content.created_at') }}</th>
                            <th nowrap></th>
                        </tr>
                        @foreach($items as $item)
                            <tr>
                                <td nowrap>{{ $item->id }}</td>
                                <td nowrap>{{ $item->question }}</td>
                                <td nowrap>{{ $item->is_active }}</td>
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
      
    </div>
@endsection
