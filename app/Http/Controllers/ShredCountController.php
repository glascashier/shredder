<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ShredCount;

class ShredCountController extends Controller
{
    // 현재 카운트 가져오기
    public function index()
    {
        $record = ShredCount::first();
        return response()->json(['count' => $record->count]);
    }

    // 카운트 증가시키기
    public function increment()
    {
        $record = ShredCount::first();
        $record->count += 1;
        $record->save();

        return response()->json(['count' => $record->count]);
    }
}
