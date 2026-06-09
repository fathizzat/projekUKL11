<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kas_anggota', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kas_organisasi_id')->constrained('kas_organisasis')->cascadeOnDelete();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->enum('status', ['pending', 'accepted', 'rejected'])->default('pending');
            $table->timestamps();

            $table->unique(['kas_organisasi_id', 'user_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kas_anggota');
    }
};
