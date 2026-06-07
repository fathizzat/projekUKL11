<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Transaksi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Super Admin
        $admin = User::create([
            'name'     => 'Super Admin',
            'email'    => 'superadmin@kasdigital.com',
            'password' => Hash::make('password'),
            'role'     => 'super_admin',
        ]);

        // Bendahara
        $bendahara = User::create([
            'name'     => 'Bendahara Kelas',
            'email'    => 'bendahara@kasdigital.com',
            'password' => Hash::make('password'),
            'role'     => 'bendahara',
        ]);

        // Anggota
        $anggota1 = User::create([
            'name'     => 'Ahmad Fauzi',
            'email'    => 'ahmad@kasdigital.com',
            'password' => Hash::make('password'),
            'role'     => 'anggota',
        ]);

        $anggota2 = User::create([
            'name'     => 'Siti Nurhaliza',
            'email'    => 'siti@kasdigital.com',
            'password' => Hash::make('password'),
            'role'     => 'anggota',
        ]);

        $anggota3 = User::create([
            'name'     => 'Budi Santoso',
            'email'    => 'budi@kasdigital.com',
            'password' => Hash::make('password'),
            'role'     => 'anggota',
        ]);

        // Transaksi Contoh
        Transaksi::create([
            'user_id'          => $bendahara->id,
            'jenis_transaksi'  => 'pemasukan',
            'nominal'          => 500000,
            'keterangan'       => 'Iuran Kas Minggu ke-1 Mei',
            'tanggal'          => '2026-05-05',
        ]);

        Transaksi::create([
            'user_id'          => $bendahara->id,
            'jenis_transaksi'  => 'pemasukan',
            'nominal'          => 500000,
            'keterangan'       => 'Iuran Kas Minggu ke-2 Mei',
            'tanggal'          => '2026-05-12',
        ]);

        Transaksi::create([
            'user_id'          => $bendahara->id,
            'jenis_transaksi'  => 'pemasukan',
            'nominal'          => 500000,
            'keterangan'       => 'Iuran Kas Minggu ke-3 Mei',
            'tanggal'          => '2026-05-19',
        ]);

        Transaksi::create([
            'user_id'          => $admin->id,
            'jenis_transaksi'  => 'pengeluaran',
            'nominal'          => 250000,
            'keterangan'       => 'Pembelian ATK Kelas',
            'tanggal'          => '2026-05-15',
        ]);

        Transaksi::create([
            'user_id'          => $admin->id,
            'jenis_transaksi'  => 'pengeluaran',
            'nominal'          => 150000,
            'keterangan'       => 'Cetak Foto Kelas',
            'tanggal'          => '2026-05-20',
        ]);

        Transaksi::create([
            'user_id'          => $bendahara->id,
            'jenis_transaksi'  => 'pemasukan',
            'nominal'          => 500000,
            'keterangan'       => 'Iuran Kas Minggu ke-1 Juni',
            'tanggal'          => '2026-06-02',
        ]);

        Transaksi::create([
            'user_id'          => $admin->id,
            'jenis_transaksi'  => 'pengeluaran',
            'nominal'          => 100000,
            'keterangan'       => 'Snack Rapat Kelas',
            'tanggal'          => '2026-06-05',
        ]);
    }
}
