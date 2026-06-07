<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TransaksiResource;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    /**
     * Display a listing of transaksi.
     */
    public function index()
    {
        $transaksis = Transaksi::with('user')
            ->orderBy('tanggal', 'desc')
            ->get();

        return response()->json([
            'success' => true,
            'message' => 'Data transaksi berhasil diambil.',
            'data'    => TransaksiResource::collection($transaksis),
        ]);
    }

    /**
     * Display the specified transaksi.
     */
    public function show(Transaksi $transaksi)
    {
        $transaksi->load('user');

        return response()->json([
            'success' => true,
            'message' => 'Detail transaksi berhasil diambil.',
            'data'    => new TransaksiResource($transaksi),
        ]);
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

        $validated['user_id'] = $request->user()->id;

        $transaksi = Transaksi::create($validated);
        $transaksi->load('user');

        return response()->json([
            'success' => true,
            'message' => 'Transaksi berhasil ditambahkan.',
            'data'    => new TransaksiResource($transaksi),
        ], 201);
    }

    /**
     * Update the specified transaksi.
     */
    public function update(Request $request, Transaksi $transaksi)
    {
        $validated = $request->validate([
            'jenis_transaksi' => ['required', 'in:pemasukan,pengeluaran'],
            'nominal'         => ['required', 'numeric', 'min:1'],
            'keterangan'      => ['nullable', 'string', 'max:500'],
            'tanggal'         => ['required', 'date'],
        ]);

        $transaksi->update($validated);
        $transaksi->load('user');

        return response()->json([
            'success' => true,
            'message' => 'Transaksi berhasil diperbarui.',
            'data'    => new TransaksiResource($transaksi),
        ]);
    }

    /**
     * Remove the specified transaksi.
     */
    public function destroy(Transaksi $transaksi)
    {
        $transaksi->delete();

        return response()->json([
            'success' => true,
            'message' => 'Transaksi berhasil dihapus.',
        ]);
    }
}
