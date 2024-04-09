@extends('admin.layouts.main')

@section('content_header')
    <h1>Mail templates</h1>
@endsection

@section('content')
    <div class="box">
        <div class="box-body table-responsive">
            @if(!is_null($items) && count($items) > 0)
                <table class="table table-hover">
                    <tr>
                        <th nowrap>Name</th>
                    </tr>
                    @foreach($items as $item)
                        <tr>
                            <td nowrap><a target="_blank" rel="nofollow noopener" href="{{route('admin.mail_templates.view', $item['name'])}}">{{ $item['name']}}</a></td>
                        </tr>
                    @endforeach
                </table>
            @else
                @include('admin.layouts.partials.kernel.no_items')
            @endif
        </div>
    </div>
@endsection
