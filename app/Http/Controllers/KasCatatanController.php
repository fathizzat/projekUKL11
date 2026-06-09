<?php

namespace App\Http\Controllers;

use App\Models\KasCatatan;
use App\Models\KasOrganisasi;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class KasCatatanController extends Controller
{
    use AuthorizesRequests;

    public function store(Request $request, KasOrganisasi $organisasi)
    {
        if (!in_array(auth()->user()->role, ['bendahara', 'super_admin'], true)) {
            abort(403);
        }

        $validated = $request->validate([
            'judul' => ['required', 'string', 'max:100'],
            'isi' => ['required', 'string'],
            'tanggal' => ['required', 'date'],
        ]);

        KasCatatan::create([
            'kas_organisasi_id' => $organisasi->id,
            'user_id' => auth()->id(),
            'judul' => $validated['judul'],
            'isi' => $validated['isi'],
            'tanggal' => $validated['tanggal'],
        ]);

        return back()->with('success', 'Catatan kas berhasil ditambahkan.');
    }

    public function update(Request $request, KasOrganisasi $organisasi, KasCatatan $catatan)
    {
        if (!in_array(auth()->user()->role, ['bendahara', 'super_admin'], true)) {
            abort(403);
        }

        $validated = $request->validate([
            'judul' => ['required', 'string', 'max:100'],
            'isi' => ['required', 'string'],
            'tanggal' => ['required', 'date'],
        ]);

        $catatan->update($validated);

        return back()->with('success', 'Catatan kas berhasil diperbarui.');
    }

    public function destroy(KasOrganisasi $organisasi, KasCatatan $catatan)
    {
        if (!in_array(auth()->user()->role, ['bendahara', 'super_admin'], true)) {
            abort(403);
        }

        $catatan->delete();

        return back()->with('success', 'Catatan kas berhasil dihapus.');
    }
}
