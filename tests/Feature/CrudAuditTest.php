<?php

use App\Models\KasOrganisasi;
use App\Models\User;

it('prevents an anggota from creating a kas organization through the CRUD route', function () {
    $anggota = User::factory()->create(['role' => 'anggota']);

    $this->actingAs($anggota)
        ->get(route('organisasi.create'))
        ->assertForbidden();
});

it('prevents a bendahara from editing another bendahara kas', function () {
    $owner = User::factory()->create(['role' => 'bendahara']);
    $otherBendahara = User::factory()->create(['role' => 'bendahara']);

    $kas = KasOrganisasi::create([
        'nama_organisasi' => 'Kas Milik Owner',
        'kode_kelas' => 'KAS-OWNER-2026',
        'nominal_iuran' => 50000,
        'periode_iuran' => 'bulanan',
        'saldo' => 0,
        'created_by' => $owner->id,
    ]);

    $this->actingAs($otherBendahara)
        ->patch(route('organisasi.update', $kas), [
            'nama_organisasi' => 'Kas Diedit',
            'nominal_iuran' => 60000,
            'periode_iuran' => 'bulanan',
        ])
        ->assertForbidden();
});

it('allows a super admin to delete a kas organization', function () {
    $superAdmin = User::factory()->create(['role' => 'super_admin']);

    $kas = KasOrganisasi::create([
        'nama_organisasi' => 'Kas Dihapus Super Admin',
        'kode_kelas' => 'KAS-DELETE-SUPER-2026',
        'nominal_iuran' => 50000,
        'periode_iuran' => 'bulanan',
        'saldo' => 0,
        'created_by' => $superAdmin->id,
    ]);

    $this->actingAs($superAdmin)
        ->delete(route('organisasi.destroy', $kas))
        ->assertRedirect(route('organisasi.index'));

    $this->assertDatabaseMissing('kas_organisasis', ['id' => $kas->id]);
});

it('prevents the last super admin from deleting their own account', function () {
    $superAdmin = User::factory()->create(['role' => 'super_admin']);

    $this->actingAs($superAdmin)
        ->delete(route('user.destroy', $superAdmin))
        ->assertForbidden();
});
