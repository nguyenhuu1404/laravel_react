<?php

namespace App\Exceptions;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Validation\ValidationException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
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
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param Request $request is request
     * @param Throwable $e is exception
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response|\Symfony\Component\HttpFoundation\Response
     */
    public function render($request, Throwable $e)
    {
        $statusCode = Response::HTTP_BAD_REQUEST;
        if ($e->getCode() >= Response::HTTP_INTERNAL_SERVER_ERROR) {
            $statusCode = $e->getCode();
        }
        $message = $e->getMessage() ?? __('bad_request');
        $errors = null;
        switch (true) {
            case $e instanceof AuthenticationException:
                $message = __('unauthorized');
                $statusCode = Response::HTTP_UNAUTHORIZED;
                break;

            case $e instanceof NotFoundHttpException:
                $message = __('page_not_found');
                $statusCode = Response::HTTP_NOT_FOUND;
                break;

            case $e instanceof ValidationException;
                $message = $e->getMessage();
                $statusCode = Response::HTTP_UNPROCESSABLE_ENTITY;
                break;

            case $e instanceof ModelNotFoundException:
                $message = __('model_not_found');
                $statusCode = Response::HTTP_NOT_FOUND;
                break;

            default:
                break;
        }

        if ($request->is('*api*')) {
            return $this->makeErrorResponse($statusCode, $message, $errors);
        }

        return response($message, Response::HTTP_BAD_REQUEST);
    }

    /**
     * @param int $code
     * @param string $message
     * @param array|null $errors
     * @return Response
     */
    protected function makeErrorResponse(int $code, string $message, ?array $errors = null): Response
    {
        $response = [
            'status' => false,
            'message' => $message,
            'data' => [
                'error' => $errors,
                'code' => $code,
            ],
        ];

        return response()->json($response, $code);
    }
}
