<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    // READ (list)
    public function index()
    {
        return Transaksi::all();
    }

    // CREATE
    public function store(Request $request)
    {
        $data = Transaksi::create($request->all());
        return response()->json($data);
    }

    // UPDATE
    public function update(Request $request, $id)
    {
        $data = Transaksi::findOrFail($id);
        $data->update($request->all());
        return response()->json($data);
    }

    // DELETE
    public function destroy($id)
    {
        Transaksi::destroy($id);
        return response()->json(['message' => 'deleted']);
    }
}