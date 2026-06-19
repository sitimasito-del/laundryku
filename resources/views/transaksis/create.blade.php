@extends('layouts.app')

@section('title', 'Tambah Transaksi - Laundryku')

@section('content')
    <div class="topbar">
        <div>
            <h1>Tambah Transaksi</h1>
            <p class="muted">Catat pesanan laundry baru.</p>
        </div>
    </div>

    @if ($layanans->isEmpty())
        <div class="alert error">Tambahkan layanan terlebih dahulu sebelum membuat transaksi.</div>
        <a class="btn primary" href="{{ route('layanans.create') }}">Tambah Layanan</a>
    @else
        <form class="card form" method="POST" action="{{ route('transaksis.store') }}">
            @include('transaksis.form', ['submit' => 'Simpan Transaksi'])
        </form>
    @endif
@endsection
