@extends('layouts.app')

@section('title', 'Edit Layanan - Laundryku')

@section('content')
    <div class="topbar">
        <div>
            <h1>Edit Layanan</h1>
            <p class="muted">Perbarui nama layanan atau harga.</p>
        </div>
    </div>

    <form class="card form" method="POST" action="{{ route('layanans.update', $layanan) }}">
        @method('PUT')
        @include('layanans.form', ['submit' => 'Simpan Perubahan'])
    </form>
@endsection
