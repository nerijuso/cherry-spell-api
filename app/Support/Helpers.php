<?php

use Illuminate\Support\Facades\Auth;

if (! function_exists('auth_admin')) {
    function auth_admin()
    {
        return Auth::guard('admins')->user();
    }
}
