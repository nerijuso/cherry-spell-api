<?php

use Illuminate\Support\Facades\Auth;
use Symfony\Component\VarDumper\VarDumper;

if (! function_exists('auth_user')) {
    function auth_user()
    {
        return Auth::guard()->user();
    }
}

if (! function_exists('dumper')) {
    function dumper($value)
    {
        return VarDumper::dump($value);
    }
}
