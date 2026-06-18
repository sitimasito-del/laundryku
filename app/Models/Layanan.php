<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Layanan extends Model
{
    protected $fillable = [
        'nama_layanan',
        'harga_perkg'
    ];

    public function transaksis()
    {
        return $this->hasMany(Transaksi::class);
    }
}