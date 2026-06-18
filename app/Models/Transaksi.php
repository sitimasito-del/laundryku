<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $fillable = [
        'nama_pelanggan',
        'no_hp',
        'layanan_id',
        'berat',
        'total_harga',
        'status',
        'tanggal_masuk',
        'tanggal_selesai'
    ];

    public function layanan()
    {
        return $this->belongsTo(Layanan::class);
    }
}