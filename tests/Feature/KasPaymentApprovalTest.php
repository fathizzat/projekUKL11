<?php

use App\Models\KasOrganisasi;
use App\Models\Transaksi;
use App\Models\User;

it('shows pending payment approvals for bendahara on the kas detail page', function () {
    $bendahara = User::factory()->create(['role' => 'bendahara']);
    $anggota = User::factory()->create(['role' => 'anggota']);

    $kas = KasOrganisasi::create([
        'nama_organisasi' => 'Kas Approval Payment',
        'kode_kelas' => 'KAS-APPROVAL-2026',
        'nominal_iuran' => 50000,
        'periode_iuran' => 'bulanan',
        'saldo' => 0,
        'created_by' => $bendahara->id,
    ]);

    Transaksi::create([
        'user_id' => $anggota->id,
        'kas_organisasi_id' => $kas->id,
        'jenis_transaksi' => 'pemasukan',
        'nominal' => 50000,
        'keterangan' => 'Iuran bulan ini',
        'tanggal' => now()->toDateString(),
        'status' => 'pending',
    ]);

    $this->actingAs($bendahara);

    $this->get(route('organisasi.show', $kas))
        ->assertSee('Pengajuan Pembayaran Menunggu')
        ->assertSee('Terima');
});

it('confirms anggota payment and increases kas saldo', function () {
    $bendahara = User::factory()->create(['role' => 'bendahara']);
    $anggota = User::factory()->create(['role' => 'anggota']);

    $kas = KasOrganisasi::create([
        'nama_organisasi' => 'Kas Bayar',
        'kode_kelas' => 'KAS-BAYAR-2026',
        'nominal_iuran' => 50000,
        'periode_iuran' => 'bulanan',
        'saldo' => 0,
        'created_by' => $bendahara->id,
    ]);

    $transaksi = Transaksi::create([
        'user_id' => $anggota->id,
        'kas_organisasi_id' => $kas->id,
        'jenis_transaksi' => 'pemasukan',
        'nominal' => 50000,
        'keterangan' => 'Iuran bulan ini',
        'tanggal' => now()->toDateString(),
        'status' => 'pending',
    ]);

    $this->actingAs($bendahara);

    $this->patch(route('transaksi.konfirmasi', $transaksi))->assertRedirect();

    $transaksi->refresh();
    $kas->refresh();

    expect($transaksi->status)->toBe('lunas');
    expect((float) $kas->saldo)->toBe(50000.0);
});
