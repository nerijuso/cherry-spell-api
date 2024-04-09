@extends('admin.layouts.auth')

@section('content')

    <div class="login-box">

        <div class="login-logo">
            <a href=""><b>{{ config('app.name') }}</b></a>
        </div>

        <div class="login-box-body">

            @if(session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @else
                <div class="login-box-msg">{{ trans('admin.page.auth.reset_password') }}</div>
            @endif

            <form class="pb-5" role="form" method="POST" action="{{ route('admin.password.forgot') }}">

                {{ csrf_field() }}

                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }} has-feedback">
                    <input type="email" class="form-control" placeholder="{{ trans('admin.placeholder.email') }}" name="email" value="{{ old('email') }}"/>
                    <i class="fa fa-envelope form-control-feedback" aria-hidden="true"></i>
                    @if ($errors->has('email'))
                        <span class="help-block text-center">{{ $errors->first('email') }}</span>
                    @endif
                </div>

                @if(config('captcha.admin_reset_password.enabled') === true)
                    <div class="form-group{{ $errors->has('g-recaptcha-response') ? ' has-error' : '' }} has-feedback">
                        {!! app('captcha')->display(config('captcha.admin_reset_password.attributes'), App::getLocale()) !!}
                        @if ($errors->has('g-recaptcha-response'))
                            <span class="help-block text-center">{{ $errors->first('g-recaptcha-response') }}</span>
                        @endif
                    </div>
                @endif

                <div class="row">
                    <div class="col-xs-12">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">{{ trans('admin.button.send_password_reset_link') }}</button>
                    </div>
                </div>
            </form>

            <a href="{{ route('admin.login.view') }}">{{ trans('admin.button.go_back') }}</a>

        </div>
    </div>
@endsection
