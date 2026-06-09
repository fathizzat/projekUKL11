<?php

namespace Database\Seeders;

use App\Models\User;
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

    }
}
