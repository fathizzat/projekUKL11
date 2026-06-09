<?php

use App\Models\KasOrganisasi;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('bendahara only sees kas they created on dashboard', function () {
    $bendahara = User::factory()->create(['role' => 'bendahara']);
    $otherBendahara = User::factory()->create(['role' => 'bendahara']);

    KasOrganisasi::create([
        'nama_organisasi' => 'Kas Milik Bendahara',
        'kode_kelas' => 'KAS-MILIK-2026',
        'nominal_iuran' => 5000,
        'periode_iuran' => 'bulanan',
        'saldo' => 0,
        'created_by' => $bendahara->id,
    ]);

    KasOrganisasi::create([
        'nama_organisasi' => 'Kas Milik Lain',
        'kode_kelas' => 'KAS-LAIN-2026',
        'nominal_iuran' => 7000,
        'periode_iuran' => 'bulanan',
        'saldo' => 0,
        'created_by' => $otherBendahara->id,
    ]);

    $response = $this->actingAs($bendahara)->get('/dashboard');

    $response->assertOk();
    $response->assertSee('Kas Milik Bendahara');
    $response->assertDontSee('Kas Milik Lain');
});
