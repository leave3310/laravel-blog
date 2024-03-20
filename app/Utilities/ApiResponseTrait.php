<?php

namespace App\Utilities;

use Illuminate\Http\JsonResponse;

trait ApiResponseTrait
{
    public function successResponse($data, $message, $statusCode): JsonResponse
    {
        $content = [
            "success" => true,
            "errors" => [],
            "message" => $message,
            "data" => $data
        ];
        return response()->json($content, $statusCode);
    }

    public function errorResponse($error, $message, $statusCode): JsonResponse
    {
        $content = [
            "success" => false,
            "errors" => $error,
            "message" => $message,
            "data" => []
        ];
        return response()->json($content, $statusCode);
    }
}
