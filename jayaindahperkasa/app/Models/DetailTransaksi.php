<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DetailTransaksi extends Model
{
    use HasFactory;
    protected $table = 'detailtransaksis';
    public function transaksi()
    {
        return $this->belongsTo('App\Models\transaksi');
    }

    public function inventaris()
    {
        return $this->belongsTo('App\Models\Inventaris');
    }

}
