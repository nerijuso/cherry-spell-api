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
        Route::post('{funnel}', 'FunnelController@update')->name('funnels.update')->whereNumber('funnel');
    });

    Route::group(['prefix' => 'leads'], function () {
        Route::get('/', 'LeadController@index')->name('leads');
        Route::get('{lead}', 'LeadController@view')->name('leads.view')->whereNumber('lead');
    });

    Route::group(['prefix' => 'quizzes'], function () {
        Route::group(['prefix' => 'topics'], function () {
            Route::get('/', 'Quizzes\TopicController@index')->name('quizzes.topics');
            Route::get('create', 'Quizzes\TopicController@create')->name('quizzes.topics.create');
            Route::post('store', 'Quizzes\TopicController@storeNew')->name('quizzes.topics.store');
            Route::get('{topic}', 'Quizzes\TopicController@edit')->name('quizzes.topics.edit');
            Route::post('{topic}', 'Quizzes\TopicController@update')->name('quizzes.topics.update');
        });

        Route::group(['prefix' => '{quiz}/questions'], function () {
            Route::get('/', 'Quizzes\QuestionController@index')->name('quizzes.questions');
            Route::get('create', 'Quizzes\QuestionController@create')->name('quizzes.questions.create');
            Route::post('store', 'Quizzes\QuestionController@storeNew')->name('quizzes.questions.store');
            Route::get('{question}', 'Quizzes\QuestionController@edit')->name('quizzes.questions.edit')->whereNumber('question');
            Route::post('{question}', 'Quizzes\QuestionController@update')->name('quizzes.questions.update')->whereNumber('question');
            Route::get('{question}/remove_image', 'Quizzes\QuestionController@removeImage')->name('quizzes.questions.remove_image')->whereNumber('question');

            Route::group(['prefix' => '{question}/options'], function () {
                Route::get('create', 'Quizzes\QuestionOptionController@create')->name('quizzes.questions.options.create');
                Route::post('store', 'Quizzes\QuestionOptionController@storeNew')->name('quizzes.questions.options.store');
                Route::get('{option}', 'Quizzes\QuestionOptionController@edit')->name('quizzes.questions.options.edit')->whereNumber('option');
                Route::post('{option}', 'Quizzes\QuestionOptionController@update')->name('quizzes.questions.options.update')->whereNumber('option');
                Route::get('{option}/remove_image', 'Quizzes\QuestionOptionController@removeImage')->name('quizzes.questions.options.remove_image')->whereNumber('option');
            })->whereNumber('question');
        })->whereNumber('quiz');

        Route::get('/', 'Quizzes\QuizController@index')->name('quizzes');
        Route::get('create', 'Quizzes\QuizController@create')->name('quizzes.create');
        Route::post('store', 'Quizzes\QuizController@storeNew')->name('quizzes.store');
        Route::get('{quiz}', 'Quizzes\QuizController@edit')->name('quizzes.edit')->whereNumber('quiz');
        Route::post('{quiz}', 'Quizzes\QuizController@update')->name('quizzes.update')->whereNumber('quiz');
    });

    Route::group(['prefix' => 'system'], function () {
        Route::any('my_sql_console', 'Adminer\AdminerController@index')->name('adminer');
        Route::get('view-mail-template', 'System\MailTemplateController@index')->name('mail_templates.index');
        Route::get('view-mail-template/{mailable}', 'System\MailTemplateController@view')->name('mail_templates.view');
    });
});

Route::group(['middleware' => 'guest'], function () {
    Route::get('login', 'LoginController@showLoginForm')->name('login');
    Route::post('login', 'LoginController@authenticate')->name('do_login');
});

Route::get('logout', 'LoginController@logout')->name('logout');
