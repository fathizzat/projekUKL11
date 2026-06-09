<?php

namespace App\Http\Controllers;

use App\Models\KasAnggota;
use App\Models\KasOrganisasi;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class KasAnggotaController extends Controller
{
    use AuthorizesRequests;

    public function joinByCode(Request $request)
    {
        $validated = $request->validate([
            'kode_kelas' => ['required', 'string', 'exists:kas_organisasis,kode_kelas'],
        ]);

        $organisasi = KasOrganisasi::where('kode_kelas', $validated['kode_kelas'])->firstOrFail();

        $this->authorize('join', $organisasi);

        if ($organisasi->anggota()->where('user_id', auth()->id())->exists()) {
            return redirect()->route('organisasi.show', $organisasi)
                ->with('error', 'Anda sudah pernah mengirim permintaan join untuk kas ini.');
        }

        $organisasi->anggota()->create([
            'user_id' => auth()->id(),
            'status' => 'pending',
        ]);

        return redirect()->route('organisasi.show', $organisasi)
            ->with('success', 'Permintaan bergabung berhasil dikirim. Bendahara dapat meninjaunya dari halaman detail kas.');
    }

    public function store(Request $request, KasOrganisasi $organisasi)
    {
        $this->authorize('join', $organisasi);

        if ($organisasi->anggota()->where('user_id', auth()->id())->exists()) {
            return redirect()->route('organisasi.show', $organisasi)
                ->with('error', 'Anda sudah pernah mengirim permintaan join untuk kas ini.');
        }

        $organisasi->anggota()->create([
            'user_id' => auth()->id(),
            'status' => 'pending',
        ]);

        return redirect()->route('organisasi.show', $organisasi)
            ->with('success', 'Permintaan bergabung berhasil dikirim. Bendahara dapat meninjaunya dari halaman detail kas.');
    }

    public function invite(Request $request, KasOrganisasi $organisasi)
    {
        $this->authorize('manageMembership', $organisasi);

        $validated = $request->validate([
            'user_id' => ['required', 'exists:users,id'],
        ]);

        if ($organisasi->anggota()->where('user_id', $validated['user_id'])->exists()) {
            return back()->with('error', 'User ini sudah terdaftar di kas ini.');
        }

        $organisasi->anggota()->create([
            'user_id' => $validated['user_id'],
            'status' => 'accepted',
        ]);

        return back()->with('success', 'User berhasil diundang ke kas ini.');
    }

    public function update(Request $request, KasOrganisasi $organisasi, KasAnggota $anggota)
    {
        $this->authorize('manageMembership', $organisasi);

        $validated = $request->validate([
            'status' => ['required', 'in:accepted,rejected'],
        ]);

        $anggota->update($validated);

        return back()->with('success', 'Status keanggotaan berhasil diperbarui.');
    }
}
