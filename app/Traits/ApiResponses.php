<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;

trait ApiResponses {
    protected function ok($message, $data = []): JsonResponse
    {
        return $this->success($message, $data, 200);
    }

    protected function success($message, $data = [], $statusCode = 200): JsonResponse
    {
        $response = [
            'message' => $message,
            'status' => $statusCode
        ];

        if (!empty($data)) {
            $response['data'] = $data;
        }

        return response()->json($response, $statusCode);
    }

    protected function error($message, $statusCode): JsonResponse
    {
        return response()->json([
            'message' => $message,
            'status' => $statusCode
        ], $statusCode);
    }
}
