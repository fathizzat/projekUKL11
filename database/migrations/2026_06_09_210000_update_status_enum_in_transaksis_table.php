<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        if (DB::getDriverName() !== 'mysql') {
            return;
        }

        DB::statement("ALTER TABLE transaksis MODIFY COLUMN status ENUM('pending', 'lunas', 'belum_lunas') NOT NULL DEFAULT 'pending'");
    }

    public function down(): void
    {
        if (DB::getDriverName() !== 'mysql') {
            return;
        }

        DB::statement("ALTER TABLE transaksis MODIFY COLUMN status ENUM('pending', 'lunas') NOT NULL DEFAULT 'pending'");
    }
};
