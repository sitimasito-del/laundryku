@extends('layouts.app')

@section('title', 'Layanan - Laundryku')

@section('content')
    <div class="topbar">
        <div>
            <h1>Layanan</h1>
            <p class="muted">Kelola jenis layanan laundry dan harga per kilogram.</p>
        </div>
        <a class="btn primary" href="{{ route('layanans.create') }}">+ Tambah Layanan</a>
    </div>

    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>Nama Layanan</th>
                    <th>Harga / Kg</th>
                    <th>Dipakai Transaksi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($layanans as $layanan)
                    <tr>
                        <td><strong>{{ $layanan->nama_layanan }}</strong></td>
                        <td>Rp {{ number_format($layanan->harga_perkg, 0, ',', '.') }}</td>
                        <td>{{ $layanan->transaksis_count }}</td>
                        <td>
                            <div class="actions">
                                <a class="btn small" href="{{ route('layanans.edit', $layanan) }}">Edit</a>
                                <form method="POST" action="{{ route('layanans.destroy', $layanan) }}" onsubmit="return confirm('Hapus layanan ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn danger small" type="submit">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4">Belum ada layanan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="pagination">{{ $layanans->links() }}</div>
@endsection
