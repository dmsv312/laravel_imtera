<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function show(): JsonResponse
    {
        return response()->json([
            'yandex_url' => 'https://example.com/yandex-card',
        ]);
    }

    public function update(Request $request): JsonResponse
    {
        $data = $request->validate([
            'yandex_url' => ['required', 'string'],
        ]);

        return response()->json([
            'yandex_url' => $data['yandex_url'],
        ]);
    }
}
