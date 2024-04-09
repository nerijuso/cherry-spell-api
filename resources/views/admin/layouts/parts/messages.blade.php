@if (isset($errors) && count($errors) > 0 || Session::has('alert-success'))
    <div class="row">
        <div class="col-xs-12">
            @if (isset($errors) && count($errors) > 0)
                <div class="alert alert-danger alert-dismissible">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if(Session::has('alert-success'))
                <div class="alert alert-success">
                    <p>{{ Session::get('alert-success') }}</p>
                </div>
            @endif
        </div>
    </div>
@endif
