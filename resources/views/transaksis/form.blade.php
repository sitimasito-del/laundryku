@csrf

<div class="form-grid">
    <div class="field">
        <label for="nama_pelanggan">Nama Pelanggan</label>
        <input id="nama_pelanggan" name="nama_pelanggan" value="{{ old('nama_pelanggan', $transaksi->nama_pelanggan ?? '') }}" required>
        @error('nama_pelanggan') <span class="error-text">{{ $message }}</span> @enderror
    </div>

    <div class="field">
        <label for="no_hp">Nomor HP</label>
        <input id="no_hp" name="no_hp" value="{{ old('no_hp', $transaksi->no_hp ?? '') }}" required>
        @error('no_hp') <span class="error-text">{{ $message }}</span> @enderror
    </div>

    <div class="field">
        <label for="layanan_id">Layanan</label>
        <select id="layanan_id" name="layanan_id" required>
            <option value="">Pilih layanan</option>
            @foreach ($layanans as $layanan)
                <option value="{{ $layanan->id }}" @selected((string) old('layanan_id', $transaksi->layanan_id ?? '') === (string) $layanan->id)>
                    {{ $layanan->nama_layanan }} - Rp {{ number_format($layanan->harga_perkg, 0, ',', '.') }}/kg
                </option>
            @endforeach
        </select>
        @error('layanan_id') <span class="error-text">{{ $message }}</span> @enderror
    </div>

    <div class="field">
        <label for="berat">Berat (kg)</label>
        <input id="berat" name="berat" type="number" min="0.1" step="0.1" value="{{ old('berat', $transaksi->berat ?? '') }}" required>
        @error('berat') <span class="error-text">{{ $message }}</span> @enderror
    </div>

    <div class="field">
        <label for="status">Status</label>
        <select id="status" name="status" required>
            @foreach ($statuses as $status)
                <option value="{{ $status }}" @selected(old('status', $transaksi->status ?? 'Masuk') === $status)>{{ $status }}</option>
            @endforeach
        </select>
        @error('status') <span class="error-text">{{ $message }}</span> @enderror
    </div>

    <div class="field">
        <label for="tanggal_masuk">Tanggal Masuk</label>
        <input id="tanggal_masuk" name="tanggal_masuk" type="datetime-local" value="{{ old('tanggal_masuk', isset($transaksi) && $transaksi->tanggal_masuk ? $transaksi->tanggal_masuk->format('Y-m-d\TH:i') : now()->format('Y-m-d\TH:i')) }}">
        @error('tanggal_masuk') <span class="error-text">{{ $message }}</span> @enderror
    </div>

    <div class="field">
        <label for="tanggal_selesai">Tanggal Selesai</label>
        <input id="tanggal_selesai" name="tanggal_selesai" type="datetime-local" value="{{ old('tanggal_selesai', isset($transaksi) && $transaksi->tanggal_selesai ? $transaksi->tanggal_selesai->format('Y-m-d\TH:i') : '') }}">
        @error('tanggal_selesai') <span class="error-text">{{ $message }}</span> @enderror
    </div>
</div>

<div class="form-actions">
    <button class="btn primary" type="submit">{{ $submit }}</button>
    <a class="btn" href="{{ route('transaksis.index') }}">Batal</a>
</div>
