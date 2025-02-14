<?php

namespace App\Exceptions;

use Akbarali\ViewModel\Presenters\ApiResponse;
use ErrorException;
use Exception;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Exceptions\PostTooLargeException;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
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
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
        });
    }

    public function render($request, Throwable $e)
    {
        if ($request->is('api/*')) {

            if ($e instanceof ValidationException) {
                return ApiResponse::getErrorResponse($e->validator->errors()->first(), -422);
            }

            if ($e instanceof AuthenticationException) {
                return ApiResponse::getErrorResponse(__('auth.unauthenticated'), -401);
            }

            if ($e instanceof OperationException) {
                return ApiResponse::getErrorResponse($e->getMessage(), -422);
            }

            if ($e instanceof AuthorizationException) {
                return ApiResponse::getErrorResponse(__('messages.not_access'), -403);
            }

            if ($e instanceof LoginFailedException) {
                return ApiResponse::getErrorResponse(__('auth.failed'), -401);
            }

            if ($e instanceof NotFoundHttpException) {
                return ApiResponse::getErrorResponse(__('messages.page_not_found'), -404);
            }

            if ($e instanceof ModelNotFoundException) {
                return ApiResponse::getErrorResponse(__('messages.not_found'), -404);
            }

            if ($e instanceof QueryException || $e instanceof ErrorException || $e instanceof \TypeError) {
                return ApiResponse::getErrorResponse($e->getMessage(), -500);
            }

            if ($e instanceof UpdatePasswordException) {
                return ApiResponse::getErrorResponse(__('messages.old_password_is_not_correct'), -422);
            }

            if ($e instanceof ClientException) {
                return ApiResponse::getErrorResponse($e->getMessage(), -422);
            }

            if ($e instanceof AttemptException) {
                return ApiResponse::getErrorResponse(__('messages.attempt_does_not_allowed'), -422);
            }

            if ($e instanceof MethodNotAllowedHttpException) {
                return ApiResponse::getErrorResponse($e->getMessage(), $e->getCode());
            }

            if ($e instanceof InvalidTokenException) {
                return ApiResponse::getErrorResponse(__('messages.invalid_token'), -422);
            }

            if ($e instanceof PostTooLargeException) {
                return ApiResponse::getErrorResponse(__('messages.file_too_large'), -400);
            }

            if ($e instanceof Exception) {
                return ApiResponse::getErrorResponse($e->getMessage(), -500);
            }
        }

        return parent::render($request, $e);
    }
}
