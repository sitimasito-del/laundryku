<?php

namespace App\Http\Controllers;

use App\Models\Layanan;
use App\Models\Transaksi;

class DashboardController extends Controller
{
    public function index()
    {
        $totalLayanan = Layanan::count();
        $totalTransaksi = Transaksi::count();
        $pendapatan = Transaksi::whereIn('status', ['Selesai', 'Diambil'])
            ->sum('total_harga');
        $transaksiAktif = Transaksi::whereIn('status', ['Masuk', 'Diproses'])
            ->count();
        $statusCounts = Transaksi::selectRaw('status, count(*) as total')
            ->groupBy('status')
            ->pluck('total', 'status');
        $transaksis = Transaksi::with('layanan')
            ->latest()
            ->take(8)
            ->get();

        return view('dashboard', [
            'totalLayanan' => $totalLayanan,
            'totalTransaksi' => $totalTransaksi,
            'pendapatan' => $pendapatan,
            'transaksiAktif' => $transaksiAktif,
            'statusCounts' => $statusCounts,
            'transaksis' => $transaksis,
        ]);
    }
}
