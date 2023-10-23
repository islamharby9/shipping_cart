<?php

use Illuminate\Http\JsonResponse;

/**
 * @param string $message
 * @param mixed|null $data
 * @param int $status
 * @return JsonResponse
 */
function apiSuccessResponse(string $message, mixed $data = null, int $status = 200): JsonResponse
{
    return response()->json(['message' => $message, 'data' => $data], $status);
}

/**
 * @param array $errors
 * @param int $status
 * @return JsonResponse
 */
function apiErrorResponse(array $errors, int $status): JsonResponse
{
    return response()->json(['errors' => $errors], $status);
}
