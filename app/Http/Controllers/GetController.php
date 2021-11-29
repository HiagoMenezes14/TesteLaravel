<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class GetController extends Controller
{

    public function doesntWorks(): JsonResponse
    {
        return response()->json([
            'funcionando' => false
        ], Response::HTTP_BAD_REQUEST);

    }

    public function itWorks(): JsonResponse
    {
        return response()->json([
            'funcionando' => true
        ]);

    }

    public function testBody(Request $request): JsonResponse
    {
        $input = $request->all();
        return response()->json($input);
    }
}
