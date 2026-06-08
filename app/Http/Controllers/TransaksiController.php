<?php

namespace App\Http\Controllers;

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
        ]);

        $validated['user_id'] = auth()->id();
        $validated['status'] = in_array(auth()->user()->role, ['bendahara', 'super_admin']) ? 'lunas' : 'pending';

        Transaksi::create($validated);

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

        $transaksi->update(['status' => 'lunas']);

        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil dikonfirmasi.');
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