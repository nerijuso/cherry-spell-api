@extends('admin.layouts.auth')

@section('content')

    <div class="container container-tight py-4">
        <div class="text-center mb-4">
            <a href="/" class="navbar-brand navbar-brand-autodark">
                {{ config('app.name') }}
            </a>
        </div>
        <div class="card card-md">
            <div class="card-body">
                <h2 class="h2 text-center mb-4">Login to your account</h2>
                <form action="{{ route('admin.do_login') }}" method="POST" autocomplete="off" novalidate="">
                    {{ csrf_field() }}



                    <div class="mb-3 {{ $errors->has('email') ? 'has-error' : '' }}">
                        <label class="form-label">Email address</label>
                        <input type="email" class="form-control" placeholder="youremail@email.email" name="email" autocomplete="off" value="{{ old('email') }}">
                        @if ($errors->has('email'))
                            <div class="alert alert-danger">{{ $errors->first('email') }}</div>
                        @endif
                    </div>

                    <div class="mb-2">
                        <label class="form-label">
                            Password
                        </label>
                        <input type="password" class="form-control" placeholder="Password" name="password"/>

                        @if ($errors->has('password'))
                            <div class="alert alert-danger">{{ $errors->first('password') }}</div>
                        @endif
                    </div>

                    <div class="form-footer">
                        <button type="submit" class="btn btn-primary w-100">Sign in</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
