<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailTransaksi extends Model
{
    use HasFactory;

    public function transaksi()
    {
        return $this->belongsTo('App\Models\transaksi');
    }

    public function produk()
    {
        return $this->belongsTo('App\Models\Produk');
    }
}
