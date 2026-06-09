<?php

use App\Models\KasOrganisasi;
use App\Models\User;

it('allows a bendahara to update kas saldo', function () {
    $bendahara = User::factory()->create(['role' => 'bendahara']);
    $kas = KasOrganisasi::create([
        'nama_organisasi' => 'Kas Testing',
        'kode_kelas' => 'KAS-TESTING-2026',
        'nominal_iuran' => 50000,
        'periode_iuran' => 'bulanan',
        'saldo' => 0,
        'created_by' => $bendahara->id,
    ]);

    $this->actingAs($bendahara);

    $this->post(route('organisasi.saldo.update', $kas), [
        'jenis' => 'tambah',
        'nominal' => 250000,
        'keterangan' => 'Setoran awal',
    ])->assertRedirect();

    $kas->refresh();
    expect((float) $kas->saldo)->toBe(250000.0);

    $this->post(route('organisasi.saldo.update', $kas), [
        'jenis' => 'kurang',
        'nominal' => 50000,
        'keterangan' => 'Pembelian perlengkapan',
    ])->assertRedirect();

    $kas->refresh();
    expect((float) $kas->saldo)->toBe(200000.0);
});

it('allows a bendahara to invite an existing user to the kas', function () {
    $bendahara = User::factory()->create(['role' => 'bendahara']);
    $anggota = User::factory()->create(['role' => 'anggota']);

    $kas = KasOrganisasi::create([
        'nama_organisasi' => 'Kas Undangan',
        'kode_kelas' => 'KAS-UNDANGAN-2026',
        'nominal_iuran' => 30000,
        'periode_iuran' => 'bulanan',
        'saldo' => 0,
        'created_by' => $bendahara->id,
    ]);

    $this->actingAs($bendahara);

    $this->post(route('organisasi.invite.store', $kas), [
        'user_id' => $anggota->id,
    ])->assertRedirect();

    $this->assertDatabaseHas('kas_anggota', [
        'kas_organisasi_id' => $kas->id,
        'user_id' => $anggota->id,
        'status' => 'accepted',
    ]);
});
