<?php

namespace App\Http\Controllers\Api\Traits;

use Illuminate\Http\JsonResponse;

trait SendsResponses
{
    protected function success(
        string $message = '',
        mixed $data = null
    ) {
        return response()->json([
            'status' => true,
            'message' => $message ?? config('general.messages.request.success'),
            'data' => $data
        ], JsonResponse::HTTP_OK);
    }

    protected function error(
        string $message = 'Request was unsuccessful.',
        int $code = JsonResponse::HTTP_INTERNAL_SERVER_ERROR,
        mixed $data = null
    ) {
        return response()->json([
            'status' => false,
            'message' => $message,
            'data' => $data
        ], $code);
    }
}
