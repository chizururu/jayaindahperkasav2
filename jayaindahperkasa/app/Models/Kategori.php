<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Kategori extends Model
{
    use HasFactory;
    public function transaksi()
    {
        return $this->belongsTo('App\Models\Inventaris');
    }
}
