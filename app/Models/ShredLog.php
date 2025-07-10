<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShredLog extends Model {
    protected $fillable = ['visitor_id'];
    public $timestamps = true;
}