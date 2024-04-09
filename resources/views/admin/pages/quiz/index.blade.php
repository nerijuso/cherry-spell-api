@extends('admin.layouts.main')

@section('page_head_title')
    <h1>{{ trans('admin.page.quiz.content_header.quizzes') }}</h1>
@endsection

@section('page_head_buttons')
    <div class="col-auto ms-auto d-print-none">
        <div class="btn-list">
            <a href="{{route('admin.quizzes.create') }}" class="btn btn-primary d-none d-sm-inline-block">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M12 5l0 14"></path><path d="M5 12l14 0"></path></svg>
                {{ trans('admin.page.quiz.buttons.create_quiz') }}
            </a>
        </div>
    </div>
@endsection

@section('content')
    <div class="box">
        <div class="box-header">
            <form name="filter" action="{{ route('admin.quizzes') }}" method="GET">
                <div class="row mb-3">
                    <div class="col-lg-4 col-md-3">
                        <div class="form-group">
                            <input type="text" name="title" value="{{request('title')}}" class="form-control" placeholder="Filter by name…" aria-label="Filter by name">
                        </div>
                    </div>

                    <div class="col-lg-1 col-md-3 ">
                        <button type="submit" class="btn btn-md btn-default btn-flat btn-block">Filter</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="box-body table-responsive">
            @if(!is_null($items) && $items->total() > 0)
                <div class="card">
                    <table class="table table-hover">
                        <tr>
                            <th nowrap>ID</th>
                            <th nowrap>Topic</th>
                            <th nowrap>Name</th>
                            <th nowrap>Active</th>
                            <th nowrap>Created at</th>
                            <th nowrap></th>
                        </tr>
                        @foreach($items as $item)
                            <tr>
                                <td nowrap>{{ $item->id }}</td>
                                <td nowrap>{{ $item->topic->topic }}</td>
                                <td nowrap>{{ $item->title }}</td>
                                <td nowrap>{{ $item->is_published ? 'Yes' : 'No' }}</td>
                                <td nowrap>{{ $item->created_at }}</td>
                                <td class="text-right">
                                    <a href="{{ route('admin.quizzes.edit', $item->id) }}">
                                        <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-edit"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" /><path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" /><path d="M16 5l3 3" /></svg>
                                    </a>
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
