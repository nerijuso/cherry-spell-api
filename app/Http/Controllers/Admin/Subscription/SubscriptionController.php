<?php

namespace App\Http\Controllers\Admin\Subscription;

use App\Http\Controllers\Controller as Controller;
use Illuminate\Http\Request;
use Laravel\Cashier\Subscription;

class SubscriptionController extends Controller
{
    /**
     * Display a listing of the resources.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Subscription::query();
        $items = $query->with('user')->paginate(30)->appends($request->all());

        return view('admin.pages.subscription.index', ['items' => $items]);
    }
}
