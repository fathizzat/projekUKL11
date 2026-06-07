<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

        return view('dashboard', compact(
            'totalSaldo',
            'totalPemasukan',
            'totalPengeluaran',
            'totalAnggota',
            'totalBendahara',
            'totalTransaksi',
            'transaksiTerbaru'
        ));
    }
}
