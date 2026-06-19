@extends('layouts.app')

@section('title', 'Tambah Layanan - Laundryku')

@section('content')
    <div class="topbar">
        <div>
            <h1>Tambah Layanan</h1>
            <p class="muted">Masukkan layanan baru yang tersedia.</p>
        </div>
    </div>

    <form class="card form" method="POST" action="{{ route('layanans.store') }}">
        @include('layanans.form', ['submit' => 'Simpan Layanan'])
    </form>
@endsection
