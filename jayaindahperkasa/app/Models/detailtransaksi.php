<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detailtransaksi extends Model
{
    use HasFactory;

    public function transaksi(){
        return $this->belongsTo(transaksi::class);
    }

    public function inventaris(){
        return $this->belongsTo(inventaris::class);
    }
}
