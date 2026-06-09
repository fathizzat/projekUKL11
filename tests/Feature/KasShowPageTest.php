<?php

use App\Models\KasOrganisasi;
use App\Models\User;

it('loads the kas detail page without database column errors', function () {
    $bendahara = User::factory()->create(['role' => 'bendahara']);
    $anggota = User::factory()->create(['role' => 'anggota']);

    $kas = KasOrganisasi::create([
        'nama_organisasi' => 'Kas Detail Test',
        'kode_kelas' => 'KAS-DETAIL-2026',
        'nominal_iuran' => 50000,
        'periode_iuran' => 'bulanan',
        'saldo' => 0,
        'created_by' => $bendahara->id,
    ]);

    $this->actingAs($bendahara);

    $this->get(route('organisasi.show', $kas))->assertOk();
});
