<?php

namespace App\Http\Controllers;

use App\Models\Layanan;
use Illuminate\Http\Request;

class LayananController extends Controller
{
    public function index()
    {
        $layanans = Layanan::withCount('transaksis')
            ->latest()
            ->paginate(10);

        return view('layanans.index', compact('layanans'));
    }

    public function create()
    {
        return view('layanans.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_layanan' => ['required', 'string', 'max:255'],
            'harga_perkg' => ['required', 'integer', 'min:0'],
        ]);

        Layanan::create($data);

        return redirect()
            ->route('layanans.index')
            ->with('success', 'Layanan berhasil ditambahkan.');
    }

    public function edit(Layanan $layanan)
    {
        return view('layanans.edit', compact('layanan'));
    }

    public function update(Request $request, Layanan $layanan)
    {
        $data = $request->validate([
            'nama_layanan' => ['required', 'string', 'max:255'],
            'harga_perkg' => ['required', 'integer', 'min:0'],
        ]);

        $layanan->update($data);

        return redirect()
            ->route('layanans.index')
            ->with('success', 'Layanan berhasil diperbarui.');
    }

    public function destroy(Layanan $layanan)
    {
        if ($layanan->transaksis()->exists()) {
            return redirect()
                ->route('layanans.index')
                ->with('error', 'Layanan tidak bisa dihapus karena sudah dipakai transaksi.');
        }

        $layanan->delete();

        return redirect()
            ->route('layanans.index')
            ->with('success', 'Layanan berhasil dihapus.');
    }
}
