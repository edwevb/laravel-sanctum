<?php

namespace App\Exceptions;

use Throwable;
use Illuminate\Support\Facades\Log;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\Routing\Exception\RouteNotFoundException;

class Handler extends ExceptionHandler
{
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    public function register(): void
    {
        $this->renderable(function (AuthenticationException $e, $request) {
            if ($request->wantsJson() || $request->is('api/*')) {
                return response()->json(['message' => 'unAuthenticated'], 401);
            }
        });

        $this->renderable(function (ModelNotFoundException $e, $request) {
            if ($request->wantsJson() || $request->is('api/*')) {
                return response()->json(['message' => 'Data not found'], 404);
            }
        });

        $this->renderable(function (NotFoundHttpException $e, $request) {
            if ($request->wantsJson() || $request->is('api/*')) {
                return response()->json(['message' => 'Not found'], 404);
            }
        });

        $this->renderable(function (MethodNotAllowedHttpException $e, $request) {
            if ($request->wantsJson() || $request->is('api/*')) {
                return response()->json(['message' => 'Method is not allowed for this url'], 405);
            }
        });

        $this->renderable(function (RouteNotFoundException $e, $request) {
            if ($request->wantsJson() || $request->is('api/*')) {
                return response()->json(['message' => 'Not found'], 404);
            }
        });

        $this->renderable(function (\BadMethodCallException $e, $request) {
            if ($request->wantsJson() || $request->is('api/*')) {
                return response()->json(['message' => 'Bad method'], 400);
            }
        });

        $this->reportable(function (Throwable $e) {
            Log::info($e->getMessage());
        });
    }

    public function render($request, Throwable $e)
    {
        // return $e->getMessage();
        return parent::render($request, $e);
    }
}
