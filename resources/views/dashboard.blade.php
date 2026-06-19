@extends('layouts.app')

@section('title', 'Dashboard - Laundryku')

@section('content')
    <div class="topbar">
        <div>
            <h1>Dashboard</h1>
            <p class="muted">Ringkasan operasional laundry hari ini.</p>
        </div>
        <a class="btn primary" href="{{ route('transaksis.create') }}">+ Transaksi Baru</a>
    </div>

    <section class="grid stats">
        <div class="card">
            <div class="stat-label">Total Transaksi</div>
            <div class="stat-value">{{ $totalTransaksi }}</div>
        </div>
        <div class="card">
            <div class="stat-label">Transaksi Aktif</div>
            <div class="stat-value">{{ $transaksiAktif }}</div>
        </div>
        <div class="card">
            <div class="stat-label">Total Layanan</div>
            <div class="stat-value">{{ $totalLayanan }}</div>
        </div>
        <div class="card">
            <div class="stat-label">Pendapatan Selesai</div>
            <div class="stat-value">Rp {{ number_format($pendapatan, 0, ',', '.') }}</div>
        </div>
    </section>

    <section class="grid" style="grid-template-columns: 1fr 2fr;">
        <div class="card">
            <h2 style="margin-top:0;">Status</h2>
            @foreach (['Masuk', 'Diproses', 'Selesai', 'Diambil'] as $status)
                <div style="display:flex;justify-content:space-between;margin:12px 0;">
                    <span>{{ $status }}</span>
                    <strong>{{ $statusCounts[$status] ?? 0 }}</strong>
                </div>
            @endforeach
        </div>

        <div>
            <div class="toolbar">
                <h2 style="margin:0;">Transaksi Terbaru</h2>
                <a class="btn small" href="{{ route('transaksis.index') }}">Lihat Semua</a>
            </div>
            <div class="table-wrap">
                <table>
                    <thead>
                        <tr>
                            <th>Pelanggan</th>
                            <th>Layanan</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($transaksis as $transaksi)
                            <tr>
                                <td>
                                    <strong>{{ $transaksi->nama_pelanggan }}</strong><br>
                                    <span class="muted">{{ $transaksi->no_hp }}</span>
                                </td>
                                <td>{{ $transaksi->layanan->nama_layanan ?? '-' }}</td>
                                <td>Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}</td>
                                <td><span class="badge">{{ $transaksi->status }}</span></td>
                                <td>{{ optional($transaksi->tanggal_masuk)->format('d M Y H:i') ?? '-' }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5">Belum ada transaksi.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection
