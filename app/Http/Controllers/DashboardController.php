<?php

namespace App\Http\Controllers;

use App\Models\KasOrganisasi;
use App\Models\Transaksi;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $totalPemasukan = Transaksi::where('jenis_transaksi', 'pemasukan')->sum('nominal');
        $totalPengeluaran = Transaksi::where('jenis_transaksi', 'pengeluaran')->sum('nominal');
        $totalSaldo = $totalPemasukan - $totalPengeluaran;

        $totalAnggota = User::where('role', 'anggota')->count();
        $totalBendahara = User::where('role', 'bendahara')->count();
        $totalTransaksi = Transaksi::count();

        $transaksiTerbaru = Transaksi::with('user')
            ->orderBy('tanggal', 'desc')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        $kasOrganisasis = KasOrganisasi::with('user')->latest();

        if (Auth::check() && Auth::user()->role === 'bendahara') {
            $kasOrganisasis = $kasOrganisasis->where('created_by', Auth::id());
        }

        if (Auth::check() && Auth::user()->role === 'anggota') {
            $kasOrganisasis = $kasOrganisasis->whereHas('anggota', function ($query) {
                $query->where('user_id', Auth::id())
                    ->where('status', 'accepted');
            });
        }

        $kasOrganisasis = $kasOrganisasis->get();

        $pendingJoinCount = 0;
        if (Auth::check() && in_array(Auth::user()->role, ['bendahara', 'super_admin'], true)) {
            $pendingJoinCount = \App\Models\KasAnggota::whereHas('organisasi', function ($query) {
                $query->where('created_by', Auth::id());
            })->where('status', 'pending')->count();
        }

        return view('dashboard', compact(
            'totalSaldo',
            'totalPemasukan',
            'totalPengeluaran',
            'totalAnggota',
            'totalBendahara',
            'totalTransaksi',
            'transaksiTerbaru',
            'kasOrganisasis',
            'pendingJoinCount'
        ));
    }
}
