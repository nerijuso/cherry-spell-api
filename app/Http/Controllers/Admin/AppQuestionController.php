<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

class AppQuestionController
{
    public function index(Request $request)
    {

        return view('admin.pages.app_question.index', ['items' => collect([])]);
    }
}
