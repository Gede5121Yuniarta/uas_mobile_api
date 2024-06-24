<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
        api: __DIR__.'/../routes/api.php', // Add this line to enable API routes
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            // 'user' => \App\Http\Middleware\User::class,
            // 'admin' => \App\Http\Middleware\Admin::class,
            // 'super admin' => \App\Http\Middleware\SuperAdmin::class,

            'admin' => \App\Http\Middleware\Admin::class,
            'super admin' => \App\Http\Middleware\SuperAdmin::class,
            'user' => \App\Http\Middleware\User::class,
            'checkType' => \App\Http\Middleware\CheckType::class,
            'validate-token' => \App\Http\Middleware\ValidateToken::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
