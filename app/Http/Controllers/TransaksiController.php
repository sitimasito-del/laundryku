<?php

namespace App\Http\Controllers;

use App\Models\Layanan;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function index(Request $request)
    {
        $transaksis = Transaksi::with('layanan')
            ->when($request->filled('status'), function ($query) use ($request) {
                $query->where('status', $request->status);
            })
            ->when($request->filled('q'), function ($query) use ($request) {
                $query->where(function ($query) use ($request) {
                    $query->where('nama_pelanggan', 'like', '%'.$request->q.'%')
                        ->orWhere('no_hp', 'like', '%'.$request->q.'%');
                });
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('transaksis.index', [
            'transaksis' => $transaksis,
            'statuses' => Transaksi::statuses(),
        ]);
    }

    public function create()
    {
        return view('transaksis.create', [
            'layanans' => Layanan::orderBy('nama_layanan')->get(),
            'statuses' => Transaksi::statuses(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $this->validatedData($request);
        $data['total_harga'] = $this->calculateTotal($data['layanan_id'], $data['berat']);
        $data['tanggal_masuk'] = $data['tanggal_masuk'] ?? now();
        $data['tanggal_selesai'] = $data['status'] === 'Selesai' || $data['status'] === 'Diambil'
            ? ($data['tanggal_selesai'] ?? now())
            : null;

        Transaksi::create($data);

        return redirect()
            ->route('transaksis.index')
            ->with('success', 'Transaksi berhasil ditambahkan.');
    }

    public function show(Transaksi $transaksi)
    {
        $transaksi->load('layanan');

        return view('transaksis.show', compact('transaksi'));
    }

    public function edit(Transaksi $transaksi)
    {
        return view('transaksis.edit', [
            'transaksi' => $transaksi,
            'layanans' => Layanan::orderBy('nama_layanan')->get(),
            'statuses' => Transaksi::statuses(),
        ]);
    }

    public function update(Request $request, Transaksi $transaksi)
    {
        $data = $this->validatedData($request);
        $data['total_harga'] = $this->calculateTotal($data['layanan_id'], $data['berat']);
        $data['tanggal_selesai'] = $data['status'] === 'Selesai' || $data['status'] === 'Diambil'
            ? ($data['tanggal_selesai'] ?? now())
            : null;

        $transaksi->update($data);

        return redirect()
            ->route('transaksis.index')
            ->with('success', 'Transaksi berhasil diperbarui.');
    }

    public function destroy(Transaksi $transaksi)
    {
        $transaksi->delete();

        return redirect()
            ->route('transaksis.index')
            ->with('success', 'Transaksi berhasil dihapus.');
    }

    private function validatedData(Request $request): array
    {
        return $request->validate([
            'nama_pelanggan' => ['required', 'string', 'max:255'],
            'no_hp' => ['required', 'string', 'max:30'],
            'layanan_id' => ['required', 'exists:layanans,id'],
            'berat' => ['required', 'numeric', 'min:0.1'],
            'status' => ['required', 'in:'.implode(',', Transaksi::statuses())],
            'tanggal_masuk' => ['nullable', 'date'],
            'tanggal_selesai' => ['nullable', 'date'],
        ]);
    }

    private function calculateTotal(int $layananId, float $berat): int
    {
        $layanan = Layanan::findOrFail($layananId);

        return (int) round($layanan->harga_perkg * $berat);
    }
}
