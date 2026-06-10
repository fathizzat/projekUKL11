<?php

use App\Models\KasOrganisasi;
use App\Models\User;

it('redirects an anggota to dashboard after submitting a join code and keeps the request pending', function () {
    $bendahara = User::factory()->create(['role' => 'bendahara']);
    $anggota = User::factory()->create(['role' => 'anggota']);

    $kas = KasOrganisasi::create([
        'nama_organisasi' => 'Kas Testing Pending',
        'kode_kelas' => 'KAS-PENDING-2026',
        'nominal_iuran' => 50000,
        'periode_iuran' => 'bulanan',
        'saldo' => 0,
        'created_by' => $bendahara->id,
    ]);

    $this->actingAs($anggota)
        ->post(route('organisasi.join.code'), ['kode_kelas' => $kas->kode_kelas])
        ->assertRedirect(route('dashboard'))
        ->assertSessionHas('success', 'Permintaan bergabung berhasil dikirim. Menunggu persetujuan bendahara.');

    $this->assertDatabaseHas('kas_anggota', [
        'kas_organisasi_id' => $kas->id,
        'user_id' => $anggota->id,
        'status' => 'pending',
    ]);
});

it('allows an anggota to request a join and a bendahara to approve it', function () {
    $bendahara = User::factory()->create(['role' => 'bendahara']);
    $anggota = User::factory()->create(['role' => 'anggota']);

    $kas = KasOrganisasi::create([
        'nama_organisasi' => 'Kas Testing',
        'kode_kelas' => 'KAS-TESTING-2026',
        'nominal_iuran' => 50000,
        'periode_iuran' => 'bulanan',
        'saldo' => 0,
        'created_by' => $bendahara->id,
    ]);

    $this->actingAs($anggota);

    $this->post(route('organisasi.join.store', $kas))
        ->assertRedirect();

    $this->assertDatabaseHas('kas_anggota', [
        'kas_organisasi_id' => $kas->id,
        'user_id' => $anggota->id,
        'status' => 'pending',
    ]);

    $joinRequest = \App\Models\KasAnggota::where('kas_organisasi_id', $kas->id)
        ->where('user_id', $anggota->id)
        ->firstOrFail();

    $this->actingAs($bendahara);

    $this->patch(route('organisasi.join.update', ['organisasi' => $kas, 'anggota' => $joinRequest]), [
        'status' => 'accepted',
    ])->assertRedirect();

    $joinRequest->refresh();

    expect($joinRequest->status)->toBe('accepted');
});
