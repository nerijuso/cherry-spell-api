<?php

namespace App\Http\Controllers\Admin\System;

use App\Http\Controllers\Controller as Controller;
use App\Models\User;

class MailTemplateController extends Controller
{
    public function index()
    {
        $paths = glob(app_path().'/Mail/*.php');
        $items = [];

        foreach ($paths as $path) {
            $items[]['name'] = basename($path, '.php');
        }

        return view('admin.pages.system.mail.index', ['items' => $items]);
    }

    public function view($mailable)
    {
        $class = "App\Mail\\$mailable";
        $mail = new $class(User::find(1));

        return $mail->render();
    }
}
