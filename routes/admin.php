<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', 'WelcomeController@index')->name('welcome');

    Route::group(['prefix' => 'users'], function () {
        Route::get('/', 'UserController@index')->name('users');
        Route::get('view/{user}', 'UserController@view')->name('users.view')->whereNumber('user');
    });

    Route::group(['prefix' => 'funnels'], function () {
        Route::get('/', 'FunnelController@index')->name('funnels');
        Route::get('create', 'FunnelController@create')->name('funnels.create');
        Route::post('store', 'FunnelController@storeNew')->name('funnels.store');
        Route::get('{funnel}', 'FunnelController@edit')->name('funnels.edit')->whereNumber('funnel');
        Route::get('{funnel}/pages', 'FunnelController@pages')->name('funnels.pages')->whereNumber('funnel');
        Route::post('{funnel}', 'FunnelController@update')->name('funnels.update')->whereNumber('funnel');
    });

    Route::group(['prefix' => 'quizzes'], function () {
        Route::group(['prefix' => '{quiz}/questions'], function () {
            Route::get('/', 'FunnelQuizzes\FunnelQuestionController@index')->name('quizzes.questions');
            Route::get('create', 'FunnelQuizzes\FunnelQuestionController@create')->name('quizzes.questions.create');
            Route::post('store', 'FunnelQuizzes\FunnelQuestionController@storeNew')->name('quizzes.questions.store');
            Route::get('{question}', 'FunnelQuizzes\FunnelQuestionController@edit')->name('quizzes.questions.edit')->whereNumber('question');
            Route::post('{question}', 'FunnelQuizzes\FunnelQuestionController@update')->name('quizzes.questions.update')->whereNumber('question');
            Route::get('{question}/remove_image/{size}', 'FunnelQuizzes\FunnelQuestionController@removeImage')->name('quizzes.questions.remove_image')->whereNumber('question');

            Route::group(['prefix' => '{question}/options'], function () {
                Route::get('create', 'FunnelQuizzes\FunnelQuestionOptionController@create')->name('quizzes.questions.options.create');
                Route::post('store', 'FunnelQuizzes\FunnelQuestionOptionController@storeNew')->name('quizzes.questions.options.store');
                Route::get('{option}', 'FunnelQuizzes\FunnelQuestionOptionController@edit')->name('quizzes.questions.options.edit')->whereNumber('option');
                Route::post('{option}', 'FunnelQuizzes\FunnelQuestionOptionController@update')->name('quizzes.questions.options.update')->whereNumber('option');
                Route::get('{option}/remove_image/{size}', 'FunnelQuizzes\FunnelQuestionOptionController@removeImage')->name('quizzes.questions.options.remove_image')->whereNumber('option');
            })->whereNumber('question');
        })->whereNumber('quiz');

        Route::get('/', 'FunnelQuizzes\FunnelQuizController@index')->name('quizzes');
        Route::get('create', 'FunnelQuizzes\FunnelQuizController@create')->name('quizzes.create');
        Route::post('store', 'FunnelQuizzes\FunnelQuizController@storeNew')->name('quizzes.store');
        Route::get('{quiz}', 'FunnelQuizzes\FunnelQuizController@edit')->name('quizzes.edit')->whereNumber('quiz');
        Route::post('{quiz}', 'FunnelQuizzes\FunnelQuizController@update')->name('quizzes.update')->whereNumber('quiz');
    });

    Route::group(['prefix' => 'leads'], function () {
        Route::get('/', 'LeadController@index')->name('leads');
        Route::get('{lead}', 'LeadController@view')->name('leads.view')->whereNumber('lead');
    });

    Route::group(['prefix' => 'ai-prompts'], function () {
        Route::get('/', 'AIPromptsController@index')->name('ai_prompts');
        Route::get('/{prompt}', 'AIPromptsController@edit')->name('ai_prompts.edit');
        Route::post('/{prompt}', 'AIPromptsController@update')->name('ai_prompts.update');
    });

    Route::group(['prefix' => 'subscriptions'], function () {
        Route::get('/', 'Subscription\SubscriptionController@index')->name('subscriptions');
        Route::get('plans', 'Subscription\SubscriptionPlansController@plans')->name('subscriptions.plans');
        Route::get('plans/create', 'Subscription\SubscriptionPlansController@create')->name('subscriptions.plans.create');
        Route::post('plans/store', 'Subscription\SubscriptionPlansController@store')->name('subscriptions.plans.store');
        Route::get('plans/{subscriptionPlan}', 'Subscription\SubscriptionPlansController@edit')->name('subscriptions.plans.edit');
        Route::post('plans/{subscriptionPlan}', 'Subscription\SubscriptionPlansController@update')->name('subscriptions.plans.update');
    });

    Route::group(['prefix' => 'app_questions'], function () {
        Route::get('/', 'AppQuestionController@index')->name('app_questions');
    });

    Route::group(['prefix' => 'system'], function () {
        Route::any('my_sql_console', 'Adminer\AdminerController@index')->name('adminer');
        Route::get('view-mail-template', 'System\MailTemplateController@index')->name('mail_templates.index');
        Route::get('view-mail-template/{mailable}', 'System\MailTemplateController@view')->name('mail_templates.view');

        Route::group(['prefix' => 'file_manager', 'permission' => 'use_file_manager_module'], function () {
            Route::get('/', 'FileManagerController@index')->name('system.file_manager');
            Route::post('/upload', 'FileManagerController@upload')->name('system.file_manager.upload');
            Route::get('/delete', 'FileManagerController@delete')->name('system.file_manager.delete');
        });
    });
});

Route::group(['middleware' => 'guest'], function () {
    Route::get('login', 'LoginController@showLoginForm')->name('login');
    Route::post('login', 'LoginController@authenticate')->name('do_login');
});

Route::get('logout', 'LoginController@logout')->name('logout');
