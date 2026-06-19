@csrf

<div class="form-grid">
    <div class="field">
        <label for="nama_layanan">Nama Layanan</label>
        <input id="nama_layanan" name="nama_layanan" value="{{ old('nama_layanan', $layanan->nama_layanan ?? '') }}" required>
        @error('nama_layanan') <span class="error-text">{{ $message }}</span> @enderror
    </div>

    <div class="field">
        <label for="harga_perkg">Harga per Kg</label>
        <input id="harga_perkg" name="harga_perkg" type="number" min="0" value="{{ old('harga_perkg', $layanan->harga_perkg ?? '') }}" required>
        @error('harga_perkg') <span class="error-text">{{ $message }}</span> @enderror
    </div>
</div>

<div class="form-actions">
    <button class="btn primary" type="submit">{{ $submit }}</button>
    <a class="btn" href="{{ route('layanans.index') }}">Batal</a>
</div>
