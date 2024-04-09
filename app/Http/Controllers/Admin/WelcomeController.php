<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller as Controller;

class WelcomeController extends Controller
{
    public function index()
    {
        return view('admin.pages.home');
    }
}
