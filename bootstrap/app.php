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
            'supplier_approved' => \App\Http\Middleware\CheckSupplierApproved::class,
        ]);

        $middleware->redirectGuestsTo(fn ($request) => $request->is('admin*') ? route('admin.login') : route('login'));

        $middleware->redirectUsersTo(function ($request) {
            if ($request->is('login/admin') || $request->is('admin*')) {
                return route('admin.dashboard');
            }
            if (auth('web')->check() && auth('web')->user()->hasRole('supplier')) {
                return route('supplier.dashboard');
            }
            if (auth('web')->check()) {
                return route('buyer.portal');
            }
            if (auth('admin')->check()) {
                return route('admin.dashboard');
            }
            return route('login');
        });
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
