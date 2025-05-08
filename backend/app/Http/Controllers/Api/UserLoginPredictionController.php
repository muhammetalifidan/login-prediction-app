<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\Contracts\LoginPredictionServiceInterface;
use Illuminate\Http\JsonResponse;

class UserLoginPredictionController extends Controller
{
    public function __construct(
        private LoginPredictionServiceInterface $loginPredictionService,
    ) {}

    public function index(): JsonResponse
    {
        $result = $this->loginPredictionService->getAllPredictions();

        if (!$result->success) {
            return response()->json([
                'success' => false,
                'code' => $result->code,
                'message' => $result->message,
            ], $result->code);
        }

        return response()->json([
            'success' => true,
            'code' => $result->code,
            'message' => $result->message,
            'data' => $result->data,
        ], $result->code);
    }
}
