<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class KasAnggota extends Model
{
    protected $table = 'kas_anggota';

    protected $fillable = [
        'kas_organisasi_id',
        'user_id',
        'status',
    ];

    public function organisasi(): BelongsTo
    {
        return $this->belongsTo(KasOrganisasi::class, 'kas_organisasi_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
