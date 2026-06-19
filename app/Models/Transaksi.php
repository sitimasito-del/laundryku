<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    public const STATUS_MASUK = 'Masuk';
    public const STATUS_DIPROSES = 'Diproses';
    public const STATUS_SELESAI = 'Selesai';
    public const STATUS_DIAMBIL = 'Diambil';

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

    protected $casts = [
        'berat' => 'decimal:2',
        'total_harga' => 'integer',
        'tanggal_masuk' => 'datetime',
        'tanggal_selesai' => 'datetime',
    ];

    public static function statuses(): array
    {
        return [
            self::STATUS_MASUK,
            self::STATUS_DIPROSES,
            self::STATUS_SELESAI,
            self::STATUS_DIAMBIL,
        ];
    }

    public function layanan()
    {
        return $this->belongsTo(Layanan::class);
    }
}
