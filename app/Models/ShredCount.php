<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShredCount extends Model
{
    use HasFactory;

    // ✅ 필수!
    protected $fillable = ['count'];
}
