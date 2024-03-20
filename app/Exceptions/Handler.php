<?php

namespace App\Exceptions;

use App\Utilities\ApiResponseTrait;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;
use Throwable;

class Handler extends ExceptionHandler
{
    use ApiResponseTrait;

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
            //
        });
    }

    public function render($request, Throwable $e): \Illuminate\Http\Response|\Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|\Symfony\Component\HttpFoundation\Response
    {
        if ($e instanceof ValidationException) {
            // 自定義驗證失敗時的響應

            $errors = [];
            foreach ($e->errors() as $key => $value) {
                $errors[] = [
                    "name" => $key,
                    "message" => $value
                ];
            }

            return $this->errorResponse($errors, "格式錯誤", ResponseAlias::HTTP_UNPROCESSABLE_ENTITY);

        }

        return parent::render($request, $e);
    }
}
