@extends('layouts.app')

@section('title', 'Transaksi - Laundryku')

@section('content')
    <div class="topbar">
        <div>
            <h1>Transaksi</h1>
            <p class="muted">Kelola pesanan masuk, proses, selesai, sampai diambil pelanggan.</p>
        </div>
        <a class="btn primary" href="{{ route('transaksis.create') }}">+ Transaksi Baru</a>
    </div>

    <form class="toolbar" method="GET" action="{{ route('transaksis.index') }}">
        <div class="filters">
            <input name="q" value="{{ request('q') }}" placeholder="Cari nama atau nomor HP">
            <select name="status">
                <option value="">Semua status</option>
                @foreach ($statuses as $status)
                    <option value="{{ $status }}" @selected(request('status') === $status)>{{ $status }}</option>
                @endforeach
            </select>
            <button class="btn" type="submit">Filter</button>
        </div>
        <a class="btn" href="{{ route('transaksis.index') }}">Reset</a>
    </form>

    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>Pelanggan</th>
                    <th>Layanan</th>
                    <th>Berat</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Masuk</th>
                    <th>Aksi</th>
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
                        <td>{{ number_format((float) $transaksi->berat, 2, ',', '.') }} kg</td>
                        <td>Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}</td>
                        <td><span class="badge {{ $transaksi->status === 'Diproses' ? 'orange' : ($transaksi->status === 'Selesai' ? 'blue' : ($transaksi->status === 'Diambil' ? 'green' : 'gray')) }}">{{ $transaksi->status }}</span></td>
                        <td>{{ optional($transaksi->tanggal_masuk)->format('d M Y H:i') ?? '-' }}</td>
                        <td>
                            <div class="actions">
                                <a class="btn small" href="{{ route('transaksis.show', $transaksi) }}">Detail</a>
                                <a class="btn small" href="{{ route('transaksis.edit', $transaksi) }}">Edit</a>
                                <form method="POST" action="{{ route('transaksis.destroy', $transaksi) }}" onsubmit="return confirm('Hapus transaksi ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn danger small" type="submit">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7">Belum ada transaksi.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="pagination">{{ $transaksis->links() }}</div>
@endsection
