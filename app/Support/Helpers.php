<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
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

if (! function_exists('class_to_snake')) {
    function class_to_snake($value)
    {
        return Str::snake(class_basename($value));
    }
}

if (! function_exists('transform_price_id_to_public')) {
    function transform_price_id_to_public($value)
    {
        return str_replace('price_', '', $value);
    }
}

if (! function_exists('transform_price_id_back')) {
    function transform_price_id_back($value)
    {
        return 'price_'.$value;
    }
}
