<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class KasOrganisasi extends Model
{
    protected $table = 'kas_organisasis';

    protected $fillable = [
        'nama_organisasi',
        'kode_kelas',
        'nominal_iuran',
        'periode_iuran',
        'saldo',
        'created_by',
    ];

    protected function casts(): array
    {
        return [
            'nominal_iuran' => 'decimal:2',
            'saldo' => 'decimal:2',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function catatans(): HasMany
    {
        return $this->hasMany(KasCatatan::class);
    }

    public function anggota(): HasMany
    {
        return $this->hasMany(KasAnggota::class, 'kas_organisasi_id');
    }

    public function anggotaAccepted(): HasMany
    {
        return $this->anggota()->where('status', 'accepted');
    }
}
