<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('kas_organisasis', function (Blueprint $table) {
            $table->id();
            $table->string('nama_organisasi');
            $table->string('kode_kelas')->unique();
            $table->decimal('nominal_iuran', 15, 2)->default(0);
            $table->enum('periode_iuran', ['mingguan', 'bulanan', 'tahunan', 'custom'])->default('mingguan');
            $table->decimal('saldo', 15, 2)->default(0);
            $table->foreignId('created_by')->constrained('users')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kas_organisasis');
    }
};
