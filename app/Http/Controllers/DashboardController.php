<?php

namespace App\Http\Controllers;

use App\Models\Layanan;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $layanans = Layanan::all();

        $transaksis = Transaksi::with('layanan')
            ->latest()
            ->get();

        return view('dashboard', compact(
            'layanans',
            'transaksis'
        ));
    }

    public function store(Request $request)
    {
        $layanan = Layanan::findOrFail(
            $request->layanan_id
        );

        $total =
            $request->berat *
            $layanan->harga_perkg;

        Transaksi::create([
            'nama_pelanggan' => $request->nama_pelanggan,
            'no_hp' => $request->no_hp,
            'layanan_id' => $request->layanan_id,
            'berat' => $request->berat,
            'total_harga' => $total,
            'status' => 'Masuk',
            'tanggal_masuk' => now(),
        ]);

        return redirect('/');
    }
}