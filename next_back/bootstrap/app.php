<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->api(prepend: [
            \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
        ]);

        $middleware->alias([
            'verified' => \App\Http\Middleware\EnsureEmailIsVerified::class,
            'validate.project' => \App\Http\Middleware\CheckProjectRequest::class,
            'validate.trackerInProject' => \App\Http\Middleware\CheckTrackerInProjectRequest::class,
            'role' => \App\Http\Middleware\RoleRequest::class,
            'status'=> \App\Http\Middleware\StatusRequest::class,
            'priority'=> \App\Http\Middleware\PriorityRequest::class,
            'user' => \App\Http\Middleware\UserRequest::class,
            'task' => \App\Http\Middleware\TaskRequest::class
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
