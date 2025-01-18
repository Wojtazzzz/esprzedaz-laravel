<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Src\Common\Exceptions\ApplicationException;
use Src\Common\Exceptions\DomainException;
use Src\Common\Exceptions\InfrastructureException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->render(function (DomainException $exception) {
            return response()->view('common::error', ['message' => $exception->getMessage()]);
        });

        $exceptions->render(function (ApplicationException $exception) {
            return response()->view('common::error', ['message' => $exception->getMessage()]);
        });

        $exceptions->render(function (InfrastructureException $exception) {
            return response()->view('common::error', ['message' => $exception->getMessage()]);
        });
    })->create();
