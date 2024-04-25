<?php

use App\Http\Controllers\API\v1\SubscriptionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'v1', 'namespace' => 'App\Http\Controllers\API\v1'], function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    })->middleware('auth:sanctum');

    Route::group(['prefix' => 'funnels'], function () {
        Route::get('/{funnel}', 'FunnelController@index')->name('funnels');
        Route::post('/{funnel}/quiz-data', 'FunnelController@storeQuizData')->name('funnels.store_quiz');
    });

    Route::group(['prefix' => 'leads'], function () {
        Route::get('{lead}/summary', 'LeadController@summary')->name('leaders.summary');
    });

    Route::post('{funnelID}/checkout', [SubscriptionController::class, 'checkout'])->name('checkout')->whereNumber('funnelID');
});
