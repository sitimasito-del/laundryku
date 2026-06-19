@extends('layouts.app')

@section('title', 'Edit Transaksi - Laundryku')

@section('content')
    <div class="topbar">
        <div>
            <h1>Edit Transaksi</h1>
            <p class="muted">Perbarui data pelanggan, layanan, berat, atau status.</p>
        </div>
    </div>

    <form class="card form" method="POST" action="{{ route('transaksis.update', $transaksi) }}">
        @method('PUT')
        @include('transaksis.form', ['submit' => 'Simpan Perubahan'])
    </form>
@endsection
