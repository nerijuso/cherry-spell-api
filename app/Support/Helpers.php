<?php

use Illuminate\Support\Facades\Auth;
use Symfony\Component\VarDumper\VarDumper;

if (! function_exists('auth_admin')) {
    function auth_admin()
    {
        return Auth::guard('admins')->user();
    }
}

if (! function_exists('dumper')) {
    function dumper($value)
    {
        return VarDumper::dump($value);
    }
}
