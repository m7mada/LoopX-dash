<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var string[]
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var string[]
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });

        $this->renderable(function (Throwable $e, $request) {
            // Return JSON structure for API or JSON-expected requests
            if ($request->expectsJson() || $request->is('api/*')) {
                // Handle common framework exceptions first
                if ($e instanceof ValidationException) {
                    return response()->json([
                        'success' => false,
                        'message' => 'The given data was invalid.',
                        'errors'  => $e->errors(),
                    ], 422);
                }

                if ($e instanceof AuthenticationException) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Unauthenticated.',
                    ], 401);
                }

                if ($e instanceof AuthorizationException) {
                    return response()->json([
                        'success' => false,
                        'message' => 'This action is unauthorized.',
                    ], 403);
                }

                if ($e instanceof ModelNotFoundException) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Resource not found.',
                    ], 404);
                }

                if ($e instanceof NotFoundHttpException) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Route not found.',
                    ], 404);
                }

                $status = 500;
                $message = 'Server Error.';

                if ($e instanceof HttpExceptionInterface) {
                    $status = $e->getStatusCode();
                    $message = $e->getMessage() ?: $message;
                } elseif ($e->getMessage()) {
                    $message = $e->getMessage();
                }

                $payload = [
                    'success' => false,
                    'message' => $message,
                ];

                if (config('app.debug')) {
                    $payload['exception'] = get_class($e);
                    $payload['trace'] = collect($e->getTrace())->map(function ($t) {
                        return array_intersect_key($t, array_flip(['file', 'line', 'function', 'class']));
                    })->take(10);
                }

                return response()->json($payload, $status);
            }
        });
    }
}
