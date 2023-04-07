<?php

namespace App\Http\Controllers\Api\Traits;

use Illuminate\Http\JsonResponse;

trait SendsResponses
{
    protected function success(
        string $message = 'Request was successful.',
        int $code = JsonResponse::HTTP_OK,
        bool $status = true,
        mixed $data = null
    ) {
        return response()->json([
            'status' => $status,
            'message' => $message,
            'data' => $data
        ], $code);
    }

    protected function error(
        string $message = 'Request was unsuccessful.',
        int $code = JsonResponse::HTTP_INTERNAL_SERVER_ERROR,
        bool $status = false,
        mixed $data = null
    ) {
        return response()->json([
            'status' => $status,
            'message' => $message,
            'data' => $data
        ], $code);
    }
}
