<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\ShredController;
use App\Http\Controllers\ShredCountController;
use App\Models\ShredLog;

// ✅ ShredController 라우트
Route::get('/shreds', [ShredController::class, 'get']);
Route::post('/shreds', [ShredController::class, 'increment']);

// ✅ ShredCountController 라우트
Route::get('/shred-count', [ShredCountController::class, 'index']);
Route::post('/shred-count/increment', [ShredCountController::class, 'increment']);

// ✅ 방문자 확인
Route::get('/shred-check/{visitorId}', function ($visitorId) {
    return response()->json([
        'alreadyShredded' => ShredLog::where('visitor_id', $visitorId)->exists()
    ]);
});

// ✅ 방문자 기록 및 카운트 증가
Route::post('/shred-log', function (Request $request) {
    $visitorId = $request->input('visitor_id');
    if (!$visitorId) {
        return response()->json(['error' => 'Missing visitor_id'], 400);
    }

    if (ShredLog::where('visitor_id', $visitorId)->exists()) {
        return response()->json(['message' => 'Already shredded'], 200);
    }

    \App\Models\ShredCount::increment('count');
    ShredLog::create(['visitor_id' => $visitorId]);

    return response()->json(['message' => 'Shredded']);
});
