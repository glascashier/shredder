<?php
// database/migrations/xxxx_create_shred_logs_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('shred_logs', function (Blueprint $table) {
            $table->id();
            $table->string('visitor_id')->unique(); // ✅ 유니크한 브라우저 ID
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('shred_logs');
    }
};
