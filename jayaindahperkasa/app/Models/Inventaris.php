<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Inventaris extends Model
{
    use HasFactory;
    public function detailtransaksi()
    {
        return $this->belongsTo('App\Models\detailtransaksi');
    }

    /**
     * Get the Jabatan that owns the karyawan
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function kategori()
    {
        return $this->belongsTo('App\Models\Kategori');
    }
}
