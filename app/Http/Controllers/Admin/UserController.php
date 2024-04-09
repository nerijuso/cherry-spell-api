<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller as Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resources.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = User::query();

        if ($request->has('email')) {
            $query->where('email', 'LIKE', '%'.$request->input('email').'%');
        }

        $users = $query->paginate(30)->appends($request->all());

        return view('admin.pages.user.index', ['users' => $users]);
    }

    public function view(User $user)
    {
        return view('admin.pages.user.view', ['user' => $user]);
    }
}
