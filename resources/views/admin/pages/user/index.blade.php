@extends('admin.layouts.main')

@section('page_head_title')
    <h1>Users</h1>
@endsection

@section('content')
    <div class="box">
        <div class="box-header">
            <form name="filter" action="{{ route('admin.users') }}" method="GET">
                <div class="row mb-3">
                    <div class="col-lg-4 col-md-3">
                        <div class="form-group">
                            <input type="email" name="email" value="{{request('email')}}" class="form-control" placeholder="Filter by email…" aria-label="Filter by email">
                        </div>
                    </div>

                    <div class="col-lg-1 col-md-3 ">
                        <button type="submit" class="btn btn-md btn-default btn-flat btn-block">Filter</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="box-body table-responsive">
            @if(!is_null($users) && $users->total() > 0)
                <div class="card">
                    <table class="table table-hover">
                        <tr>
                            <th nowrap>ID</th>
                            <th nowrap>Name</th>
                            <th nowrap>Email</th>
                            <th nowrap>Created at</th>
                            <th nowrap></th>
                        </tr>
                        @foreach($users as $user)
                            <tr>
                                <td nowrap>{{ $user->id }}</td>
                                <td nowrap>{{ $user->name }}</td>
                                <td nowrap>{{ $user->email }}</td>
                                <td nowrap>{{ $user->created_at }}</td>
                                <td class="text-right">
                                    <a href="{{ route('admin.users.view', $user->id) }}"><svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-eye"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" /><path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" /></svg></a>
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
            {{ $users->render() }}
        </div>

    </div>
@endsection
