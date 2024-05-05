@extends('admin.layouts.main')

@section('page_head_title')
    <h1>{{ trans('admin.page.ai_prompt.content_header.ai_prompts') }}</h1>
@endsection

@section('content')
    <div class="box">
        <div class="box-body table-responsive">
            @if(!is_null($items) && $items->total() > 0)
                <div class="card">
                    <table class="table table-hover">
                        <tr>
                            <th nowrap>{{ trans('admin.page.ai_prompt.content.identifier') }}</th>
                            <th nowrap>{{ trans('admin.page.ai_prompt.content.short_desc') }}</th>
                            <th nowrap>{{ trans('admin.page.ai_prompt.content.updated_at') }}</th>
                            <th nowrap></th>
                        </tr>
                        @foreach($items as $item)
                            <tr>
                                <td nowrap>{{ $item->id }}</td>
                                <td nowrap>{{ $item->short_desc }}</td>
                                <td nowrap>{{ $item->updated_at }}</td>
                                <td class="text-right">
                                    <a href="{{ route('admin.ai_prompts.edit', $item->id) }}">
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
