<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
        then: function () {
            Route::middleware('web')
                ->prefix('admin-panel')
                ->namespace('App\Http\Controllers\Admin')
                ->name('admin.')
                ->domain(config('app.admin_domain'))
                ->group(base_path('routes/admin.php'));
        }
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->validateCsrfTokens(
            except: ['stripe/*']
        );

        $middleware->redirectGuestsTo(fn (Request $request) => route('admin.login'))->redirectUsersTo(fn (Request $request) => route('admin.welcome'));
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
