<?php

namespace App\Http\Controllers;

use App\Models\KasOrganisasi;
use App\Models\Transaksi;
use App\Models\User;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    /**
     * Display a listing of transaksi.
     */
    public function index()
    {
        $totalPemasukan = Transaksi::where('jenis_transaksi', 'pemasukan')->where('status', 'lunas')->sum('nominal');
        $totalPengeluaran = Transaksi::where('jenis_transaksi', 'pengeluaran')->where('status', 'lunas')->sum('nominal');
        $totalSaldo = $totalPemasukan - $totalPengeluaran;

        $bendahara = User::where('role', 'bendahara')->first();

        $anggotas = User::where('role', 'anggota')->get()->map(function ($user) {
            $user->total_bayar = $user->transaksis()
                ->where('jenis_transaksi', 'pemasukan')
                ->where('status', 'lunas')
                ->sum('nominal');

            $thisWeekKas = $user->transaksis()
                ->where('jenis_transaksi', 'pemasukan')
                ->whereBetween('tanggal', [now()->startOfWeek(), now()->endOfWeek()])
                ->orderBy('created_at', 'desc')
                ->first();

            if ($thisWeekKas) {
                $user->status_kas = $thisWeekKas->status;
                $user->kas_id = $thisWeekKas->id;
            } else {
                $user->status_kas = 'tunggakan';
                $user->kas_id = null;
            }

            return $user;
        });

        return view('transaksi.index', compact(
            'anggotas',
            'bendahara',
            'totalSaldo'
        ));
    }

    /**
     * Store a newly created transaksi.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'jenis_transaksi' => ['required', 'in:pemasukan,pengeluaran'],
            'nominal'         => ['required', 'numeric', 'min:1'],
            'keterangan'      => ['nullable', 'string', 'max:500'],
            'tanggal'         => ['required', 'date'],
            'kas_organisasi_id' => ['nullable', 'exists:kas_organisasis,id'],
        ]);

        $validated['user_id'] = auth()->id();
        $validated['status'] = in_array(auth()->user()->role, ['bendahara', 'super_admin']) ? 'lunas' : 'pending';

        Transaksi::create($validated);

        if (!empty($validated['kas_organisasi_id'])) {
            return redirect()->route('organisasi.show', $validated['kas_organisasi_id'])
                ->with('success', 'Pengajuan transaksi berhasil dikirim.');
        }

        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil ditambahkan.');
    }

    /**
     * Confirm a pending transaksi.
     */
    public function konfirmasi(Transaksi $transaksi)
    {
        if (!in_array(auth()->user()->role, ['bendahara', 'super_admin'])) {
            abort(403);
        }

        if ($transaksi->jenis_transaksi === 'pemasukan' && $transaksi->kas_organisasi_id) {
            $organisasi = KasOrganisasi::find($transaksi->kas_organisasi_id);
            if ($organisasi) {
                $organisasi->increment('saldo', $transaksi->nominal);
            }
        }

        if ($transaksi->jenis_transaksi === 'pengeluaran' && $transaksi->kas_organisasi_id) {
            $organisasi = KasOrganisasi::find($transaksi->kas_organisasi_id);
            if ($organisasi && $organisasi->saldo >= $transaksi->nominal) {
                $organisasi->decrement('saldo', $transaksi->nominal);
            }
        }

        $transaksi->update(['status' => 'lunas']);

        if ($transaksi->kas_organisasi_id) {
            return redirect()->route('organisasi.show', $transaksi->kas_organisasi_id)
                ->with('success', 'Transaksi berhasil dikonfirmasi.');
        }

        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil dikonfirmasi.');
    }

    public function tolak(Transaksi $transaksi)
    {
        if (!in_array(auth()->user()->role, ['bendahara', 'super_admin'])) {
            abort(403);
        }

        $transaksi->update(['status' => 'belum_lunas']);

        if ($transaksi->kas_organisasi_id) {
            return redirect()->route('organisasi.show', $transaksi->kas_organisasi_id)
                ->with('success', 'Pengajuan pembayaran ditolak.');
        }

        return redirect()->route('transaksi.index')->with('success', 'Pengajuan pembayaran ditolak.');
    }

    /**
     * Remove the specified transaksi.
     */
    public function destroy(Transaksi $transaksi)
    {
        $transaksi->delete();

        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil dihapus.');
    }
}