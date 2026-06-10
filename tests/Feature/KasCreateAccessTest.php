<?php

use App\Models\User;

it('prevents an anggota from creating a kas organization', function () {
    $anggota = User::factory()->create(['role' => 'anggota']);

    $this->actingAs($anggota)
        ->post(route('organisasi.store'), [
            'nama_organisasi' => 'Kas Anggota Baru',
            'nominal_iuran' => 50000,
            'periode_iuran' => 'bulanan',
        ])
        ->assertForbidden();

    $this->assertDatabaseMissing('kas_organisasis', [
        'nama_organisasi' => 'Kas Anggota Baru',
        'created_by' => $anggota->id,
    ]);
});
