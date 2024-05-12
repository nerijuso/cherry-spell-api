<?php

use App\Http\Controllers\API\v1\SubscriptionController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'v1', 'namespace' => 'App\Http\Controllers\API\v1'], function () {
    Route::post('/user/register', 'AuthController@register')->name('user.register');
    Route::post('/login', 'UserController@login')->name('user.login');

    Route::group(['prefix' => 'user', 'middleware' => 'auth:sanctum'], function () {
        Route::get('/', 'UserController@index')->name('user');
        Route::post('/password-reset', 'UserController@passwordReset')->name('user.password_reset');
        Route::get('/subscription-summary', 'SubscriptionController@userSubscriptionSummary')->name('users.subscription_summary');
        Route::post('/screen-name', 'UserController@updateScreenName')->name('users.update_screen_name');
        Route::post('/photo', 'UserController@uploadPhoto')->name('users.upload_photo');
    });

    Route::group(['prefix' => 'funnels'], function () {
        Route::get('{funnel}', 'FunnelController@index')->name('funnels');
        Route::post('{funnel}/quiz-data', 'FunnelController@storeQuizData')->name('funnels.store_quiz');
        Route::post('{funnel}/checkout', [SubscriptionController::class, 'checkout'])->name('funnels.checkout')->whereNumber('funnel');
        Route::post('{funnel}/validate-checkout', [SubscriptionController::class, 'validateCheckout'])->name('funnels.checkout.validate')->whereNumber('funnel');
    });

    Route::group(['prefix' => 'leads'], function () {
        Route::get('{lead}/summary', 'LeadController@summary')->name('leaders.summary');
    });

    Route::group(['prefix' => 'posts'], function () {
        Route::get('tags', 'CMSController@tags')->name('cms.tags');
        Route::get('/', 'CMSController@posts')->name('cms.posts');
        Route::get('{post}', 'CMSController@postView')->name('cms.post.view');
    });
});
