<?php

use App\Models\User;

it('allows an anggota to create a kas organization', function () {
    $anggota = User::factory()->create(['role' => 'anggota']);

    $this->actingAs($anggota);

    $this->post(route('organisasi.store'), [
        'nama_organisasi' => 'Kas Anggota Baru',
        'nominal_iuran' => 50000,
        'periode_iuran' => 'bulanan',
    ])->assertRedirect(route('dashboard'));

    $this->assertDatabaseHas('kas_organisasis', [
        'nama_organisasi' => 'Kas Anggota Baru',
        'created_by' => $anggota->id,
    ]);
});
