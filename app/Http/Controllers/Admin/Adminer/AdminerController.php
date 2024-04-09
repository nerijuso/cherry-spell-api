<?php

namespace App\Http\Controllers\Admin\Adminer;

use App\Http\Controllers\Controller;

class AdminerController extends Controller
{
    public function index()
    {
        require_once 'adminer-4.8.1-en.php';
        exit;
    }
}
