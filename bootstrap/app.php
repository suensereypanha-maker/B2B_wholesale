<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'role' => \App\Http\Middleware\RoleMiddleware::class,
        ]);

        $middleware->redirectGuestsTo(fn ($request) => $request->is('admin*') ? route('admin.login') : route('login'));

        $middleware->redirectUsersTo(fn ($request) => 
            auth('admin')->check() 
                ? route('admin.dashboard') 
                : (auth('web')->check() && auth('web')->user()->hasRole('supplier') ? route('supplier.dashboard') : route('admin.dashboard'))
        );
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
