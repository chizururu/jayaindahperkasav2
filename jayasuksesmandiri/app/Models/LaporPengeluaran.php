<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporPengeluaran extends Model
{
    protected $table = 'lapor_pengeluarans';
    use HasFactory;

    public function produk()
    {
        return $this->hasMany(Produk::class);
    }

}
