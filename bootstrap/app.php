<?php

use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->statefulApi();
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->render(function (Exception $e, Request $request) {
            if ($request->wantsJson())
            {
                switch ($e)
                {
                    case $e instanceof NotFoundHttpException:
                        return response()->json([
                            'error' => 'Resource not found',
                            'debug_message' => $e->getMessage()
                        ], $e->getStatusCode());
                    
                    case $e instanceof AuthenticationException:
                        return null; // default exception response

                    case $e instanceof HttpException:
                        return response()->json([
                            'error' => 'Http error has occurred',
                            'debug_message' => $e->getMessage()
                        ], $e->getStatusCode());

                    case $e instanceof QueryException:
                        return response()->json([
                            'error' => 'Internal Server Error',
                            'debug_message' => $e->getMessage()
                        ], 500);

                    default:
                        return response()->json([
                            'error' => 'Unkown error has occurred',
                            'debug_message' => $e->getMessage()
                        ], 500);
                }
            }
        });
    })->create();
