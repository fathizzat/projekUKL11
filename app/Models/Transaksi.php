<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class transaksi extends Model
{
    protected $fillable = [
    'nama',
    'jenis',
    'jumlah',
    'keterangan'
];
}
