@extends('layouts.app')

@section('title', 'Detail Transaksi - Laundryku')

@section('content')
    <div class="topbar">
        <div>
            <h1>Detail Transaksi</h1>
            <p class="muted">Informasi lengkap pesanan {{ $transaksi->nama_pelanggan }}.</p>
        </div>
        <div class="actions">
            <a class="btn" href="{{ route('transaksis.index') }}">Kembali</a>
            <a class="btn primary" href="{{ route('transaksis.edit', $transaksi) }}">Edit</a>
        </div>
    </div>

    <div class="card detail">
        <div><span>Pelanggan</span><strong>{{ $transaksi->nama_pelanggan }}</strong></div>
        <div><span>Nomor HP</span><strong>{{ $transaksi->no_hp }}</strong></div>
        <div><span>Layanan</span><strong>{{ $transaksi->layanan->nama_layanan ?? '-' }}</strong></div>
        <div><span>Berat</span><strong>{{ number_format((float) $transaksi->berat, 2, ',', '.') }} kg</strong></div>
        <div><span>Total Harga</span><strong>Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}</strong></div>
        <div><span>Status</span><strong>{{ $transaksi->status }}</strong></div>
        <div><span>Tanggal Masuk</span><strong>{{ optional($transaksi->tanggal_masuk)->format('d M Y H:i') ?? '-' }}</strong></div>
        <div><span>Tanggal Selesai</span><strong>{{ optional($transaksi->tanggal_selesai)->format('d M Y H:i') ?? '-' }}</strong></div>
    </div>
@endsection
