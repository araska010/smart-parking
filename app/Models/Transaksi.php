<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $fillable = [
        'plat_nomor',
        'area_parkir_id',
        'tarif_parkir_id',
        'merk',
        'model',
        'warna',
        'user_id',
        'waktu_masuk',
        'waktu_keluar',
        'durasi_jam',
        'total_bayar',
        'status',
        'kode_parkir',
    ];

    public function area()
    {
        return $this->belongsTo(AreaParkir::class, 'area_parkir_id');
    }

    public function tarif()
    {
        return $this->belongsTo(TarifParkir::class, 'tarif_parkir_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected static function booted()
    {
        static::creating(function ($transaksi) {
            do {
                $kode = '';
                $chars = 'ABCDEFGHJKLMNPQRSTUVWXYZ23456789';

                for ($i = 0; $i < 9; $i++) {
                    $kode .= $chars[random_int(0, strlen($chars) - 1)];
                }
            } while (self::where('kode_parkir', $kode)->exists());

            $transaksi->kode_parkir = $kode;
        });
    }

    public function prosesKeluar()
    {
        $this->waktu_keluar = now();

        $durasiMenit = Carbon::parse($this->waktu_masuk)
            ->diffInMinutes($this->waktu_keluar);

        $this->durasi_jam = $durasiMenit;

        $jam = ceil($durasiMenit / 60);
        $this->total_bayar = $jam * $this->tarif->tarif_per_jam;

        $this->status = 'keluar';
        $this->save();

        if ($this->area) {
            $this->area->decrement('terisi');
        }
    }
}
