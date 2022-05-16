<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ZipCodeCollection;
use App\Models\ZipCode;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class ZipCodeController extends Controller
{
    public function show($zipCode): JsonResponse|ZipCodeCollection
    {
        $result = DB::table('zip_codes')->where('d_codigo', $zipCode)->get();

        if ($result->isEmpty()) {
            return response()->json([
                'message' => 'No se encontraron resultados...',
            ]);
        }

        return response()->json(['data' => new ZipCodeCollection($result)]);
    }
}
