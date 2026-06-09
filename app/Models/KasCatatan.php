<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class KasCatatan extends Model
{
    protected $table = 'kas_catatans';

    protected $fillable = ['kas_organisasi_id', 'user_id', 'judul', 'isi', 'tanggal'];

    protected function casts(): array
    {
        return [
            'tanggal' => 'date',
        ];
    }

    public function organisasi(): BelongsTo
    {
        return $this->belongsTo(KasOrganisasi::class, 'kas_organisasi_id', 'id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
