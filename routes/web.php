<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Laravel\Cashier\Checkout;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/subscription-checkout', function (Request $request) {
    return Checkout::guest()->create('price_1P8owuJ9G5oEDfjdAm68mz5y', [
        'success_url' => ('https://cherryspell.com/your-success-route'),
        'cancel_url' => ('https://cherryspell.com/your-cancel-route'),
    ]);
});
