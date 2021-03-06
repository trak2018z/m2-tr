<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\Routing\Exception\MethodNotAllowedException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        if ($request->expectsJson())
        {
            if($exception instanceof ModelNotFoundException){
                return response()->json([
                    "success" => false,
                    "response" => [
                        "message" => "MODEL_NOT_FOUND",
                    ]
                ],404);
            } elseif ($exception instanceof MethodNotAllowedHttpException) {
                return response()->json([
                    "success" => false,
                    "response" => [
                        "message" => "BAD_REQUEST_METHOD",
                    ]
                ],405);
            } else {
                return response()->json([
                    "success" => false,
                    "response" => [
                        "message" => $exception->getMessage(),
                    ]
                ],500);
            }

        }
        return parent::render($request, $exception);
    }
}
