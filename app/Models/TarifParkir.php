<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TarifParkir extends Model
{
    protected $fillable = [
        'jenis_kendaraan',
        'tarif_per_jam'
    ];

    public function transaksis()
    {
        return $this->hasMany(Transaksi::class);
    }
}
