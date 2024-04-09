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
                <div class="login-box-msg">{{ trans('admin.page.auth.set_password') }}</div>
            @endif

            <form class="pb-5" role="form" method="POST" action="{{ route('admin.password.reset') }}">

                {{ csrf_field() }}

                <input type="hidden" name="token" value="{{ $token }}">

                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }} has-feedback">
                    <input type="email" class="form-control" placeholder="{{ trans('admin.placeholder.email') }}" name="email" value="{{ old('email') }}"/>
                    <i class="fa fa-envelope form-control-feedback" aria-hidden="true"></i>
                    @if ($errors->has('email'))
                        <span class="help-block text-center">{{ $errors->first('email') }}</span>
                    @endif
                </div>

                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }} has-feedback">
                    <input type="password" class="form-control" placeholder="{{ trans('admin.placeholder.password') }}" name="password" value=""/>
                    <i class="fa fa-lock form-control-feedback" aria-hidden="true"></i>
                    @if ($errors->has('password'))
                        <span class="help-block text-center">{{ $errors->first('password') }}</span>
                    @endif
                </div>

                <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }} has-feedback">
                    <input type="password" class="form-control" placeholder="{{ trans('admin.placeholder.password_confirmation') }}" name="password_confirmation" value=""/>
                    <i class="fa fa-lock form-control-feedback" aria-hidden="true"></i>
                    @if ($errors->has('password_confirmation'))
                        <span class="help-block text-center">{{ $errors->first('password_confirmation') }}</span>
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
                        <button type="submit" class="btn btn-primary btn-block btn-flat">{{  trans('admin.button.update_password') }}</button>
                    </div>
                </div>
            </form>

            <a href="{{ route('admin.login.view') }}">{{ trans('admin.button.go_back') }}</a>

        </div>
    </div>
@endsection
