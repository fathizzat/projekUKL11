<?php

namespace App\Http\Controllers;

use App\Models\KasCatatan;
use App\Models\KasOrganisasi;
use App\Models\Transaksi;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class KasOrganisasiController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $this->authorize('viewAny', KasOrganisasi::class);

        $kasOrganisasis = KasOrganisasi::with('user')->latest()->get();

        return view('organisasi.index', compact('kasOrganisasis'));
    }

    public function store(Request $request)
    {
        $this->authorize('create', KasOrganisasi::class);

        $validated = $request->validate([
            'nama_organisasi' => ['required', 'string', 'max:100'],
            'nominal_iuran' => ['required', 'numeric', 'min:0'],
            'periode_iuran' => ['required', 'in:mingguan,bulanan,tahunan'],
        ]);

        $validated['kode_kelas'] = $this->generateKodeKelas($validated['nama_organisasi']);
        $validated['saldo'] = 0;
        $validated['created_by'] = auth()->id();

        KasOrganisasi::create($validated);

        return redirect()->route('dashboard')->with('success', 'Kas/Organisasi berhasil dibuat.');
    }

    public function show(KasOrganisasi $organisasi)
    {
        $this->authorize('view', $organisasi);

        $anggotaList = $organisasi->anggota()->where('status', 'accepted')->with('user')->paginate(10);
        $pendingAnggota = $organisasi->anggota()->where('status', 'pending')->with('user')->latest()->get();
        $pendingTransaksis = Transaksi::where('kas_organisasi_id', $organisasi->id)
            ->where('jenis_transaksi', 'pemasukan')
            ->where('status', 'pending')
            ->with('user')
            ->latest('created_at')
            ->get();
        $catatans = KasCatatan::where('kas_organisasi_id', $organisasi->id)
            ->with('user')
            ->latest('created_at')
            ->get();
        $users = User::where('id', '!=', auth()->id())->orderBy('name')->get();

        return view('organisasi.show', compact('organisasi', 'anggotaList', 'pendingAnggota', 'pendingTransaksis', 'catatans', 'users'));
    }

    public function updateSaldo(Request $request, KasOrganisasi $organisasi)
    {
        $this->authorize('update', $organisasi);

        $validated = $request->validate([
            'jenis' => ['required', 'in:tambah,kurang'],
            'nominal' => ['required', 'numeric', 'min:1'],
            'keterangan' => ['nullable', 'string', 'max:255'],
        ]);

        if ($validated['jenis'] === 'kurang' && $organisasi->saldo < $validated['nominal']) {
            return back()->with('error', 'Saldo kas tidak mencukupi untuk pengurangan ini.');
        }

        $organisasi->saldo = $validated['jenis'] === 'tambah'
            ? $organisasi->saldo + $validated['nominal']
            : $organisasi->saldo - $validated['nominal'];

        $organisasi->save();

        $organisasi->catatans()->create([
            'user_id' => auth()->id(),
            'judul' => $validated['jenis'] === 'tambah' ? 'Penambahan saldo kas' : 'Pengurangan saldo kas',
            'isi' => $validated['keterangan'] ?? ($validated['jenis'] === 'tambah' ? 'Saldo kas ditambahkan oleh bendahara.' : 'Saldo kas dikurangi oleh bendahara.'),
            'tanggal' => now()->toDateString(),
        ]);

        return back()->with('success', 'Saldo kas berhasil diperbarui.');
    }

    public function update(Request $request, KasOrganisasi $organisasi)
    {
        $this->authorize('update', $organisasi);

        $validated = $request->validate([
            'nama_organisasi' => ['required', 'string', 'max:100'],
            'nominal_iuran' => ['required', 'numeric', 'min:0'],
            'periode_iuran' => ['required', 'in:mingguan,bulanan,tahunan'],
        ]);

        $organisasi->update($validated);

        return redirect()->route('organisasi.index')->with('success', 'Kas/Organisasi berhasil diperbarui.');
    }

    public function destroy(KasOrganisasi $organisasi)
    {
        $this->authorize('delete', $organisasi);

        $organisasi->delete();

        return redirect()->route('organisasi.index')->with('success', 'Kas/Organisasi berhasil dihapus.');
    }

    private function generateKodeKelas(string $namaOrganisasi): string
    {
        $slug = strtoupper(Str::slug($namaOrganisasi, '-'));
        $slug = trim($slug, '-');
        $slug = str_replace('-', '-', $slug);

        $kode = 'KAS-' . $slug . '-' . date('Y');

        while (KasOrganisasi::where('kode_kelas', $kode)->exists()) {
            $kode = 'KAS-' . $slug . '-' . date('Y') . '-' . random_int(100, 999);
        }

        return $kode;
    }
}
