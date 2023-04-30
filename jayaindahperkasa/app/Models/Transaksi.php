<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaksi extends Model
{
    use HasFactory;
    public function detailtransaksi(): BelongsTo
    {
        return $this->belongsTo('App\Models\detailtransaksi');
    }
}
