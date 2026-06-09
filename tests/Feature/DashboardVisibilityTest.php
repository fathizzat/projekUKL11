<?php

use App\Models\KasAnggota;
use App\Models\KasOrganisasi;
use App\Models\User;

it('shows only joined kas to anggota on dashboard', function () {
    $bendahara = User::factory()->create(['role' => 'bendahara']);
    $anggota = User::factory()->create(['role' => 'anggota']);

    $joined = KasOrganisasi::create([
        'nama_organisasi' => 'Kas Joined',
        'kode_kelas' => 'KAS-JOINED-2026',
        'nominal_iuran' => 50000,
        'periode_iuran' => 'bulanan',
        'saldo' => 0,
        'created_by' => $bendahara->id,
    ]);

    $other = KasOrganisasi::create([
        'nama_organisasi' => 'Kas Other',
        'kode_kelas' => 'KAS-OTHER-2026',
        'nominal_iuran' => 50000,
        'periode_iuran' => 'bulanan',
        'saldo' => 0,
        'created_by' => $bendahara->id,
    ]);

    KasAnggota::create([
        'kas_organisasi_id' => $joined->id,
        'user_id' => $anggota->id,
        'status' => 'accepted',
    ]);

    $this->actingAs($anggota);

    $response = $this->get(route('dashboard'));

    $response->assertOk();
    $response->assertSee($joined->nama_organisasi);
    $response->assertDontSee($other->nama_organisasi);
});
