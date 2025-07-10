<?php
use App\Http\Controllers\ShredController;

Route::get('/shreds', [ShredController::class, 'get']);
Route::post('/shreds', [ShredController::class, 'increment']);

use App\Http\Controllers\ShredCountController;

Route::get('/shred-count', [ShredCountController::class, 'index']);
Route::post('/shred-count/increment', [ShredCountController::class, 'increment']);

// routes/api.php

use Illuminate\Support\Facades\Route;
use App\Models\ShredLog;

Route::get('/shred-check/{visitorId}', function ($visitorId) {
    return response()->json([
        'alreadyShredded' => ShredLog::where('visitor_id', $visitorId)->exists()
    ]);
});

Route::post('/shred-log', function (\Illuminate\Http\Request $request) {
    $visitorId = $request->input('visitor_id');
    if (!$visitorId) return response()->json(['error' => 'Missing visitor_id'], 400);

    if (ShredLog::where('visitor_id', $visitorId)->exists()) {
        return response()->json(['message' => 'Already shredded'], 200);
    }

    \App\Models\ShredCount::increment('count');
    ShredLog::create(['visitor_id' => $visitorId]);

    return response()->json(['message' => 'Shredded']);
});
