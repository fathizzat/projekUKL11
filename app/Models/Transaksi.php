<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaksi extends Model
{
    protected $fillable = [
        'user_id',
        'kas_organisasi_id',
        'jenis_transaksi',
        'nominal',
        'keterangan',
        'tanggal',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'tanggal' => 'date',
            'nominal' => 'integer',
        ];
    }

    /**
     * Transaksi belongs to a User.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function organisasi(): BelongsTo
    {
        return $this->belongsTo(KasOrganisasi::class, 'kas_organisasi_id');
    }
}
