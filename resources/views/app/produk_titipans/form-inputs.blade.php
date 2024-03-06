@php $editing = isset($produkTitipan) @endphp

<div class="row">
    <div class="row">
        <div class="col-sm-12 mt-3">
            <label for="nama_produk" class="form-label">Nama Produk</label>
            <input type="text" name="nama_produk" id="nama_produk"
                class="form-control @error('nama_produk') is-invalid @enderror"
                value="{{ old('nama_produk', $editing ? $produkTitipan->nama_produk : '') }}" maxlength="255"
                placeholder="Masukkan nama produk" required>
            @error('nama_produk')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-sm-12 mt-3">
            <label for="nama_supplier" class="form-label">Nama Supplier</label>
            <input type="text" name="nama_supplier" id="nama_supplier"
                class="form-control @error('nama_supplier') is-invalid @enderror"
                value="{{ old('nama_supplier', $editing ? $produkTitipan->nama_supplier : '') }}" maxlength="255"
                placeholder="Masukkan nama supplier" required>
            @error('nama_supplier')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-sm-12 mt-3">
            <label for="harga_beli" class="form-label">Harga Beli</label>
            <input type="number" name="harga_beli" id="harga_beli"
                class="form-control @error('harga_beli') is-invalid @enderror"
                value="{{ old('harga_beli', $editing ? $produkTitipan->harga_beli : '') }}" step="0.01"
                placeholder="Harga beli" required>
            @error('harga_beli')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-sm-12 mt-3">
            <label for="harga_jual" class="form-label">Harga Jual</label>
            <input type="number" name="harga_jual" id="harga_jual"
                class="form-control @error('harga_jual') is-invalid @enderror"
                value="{{ old('harga_jual', $editing ? $produkTitipan->harga_jual : '') }}" step="0.01"
                placeholder="Harga jual" required>
            @error('harga_jual')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-sm-12 mt-3">
            <label for="stok" class="form-label">Stok</label>
            <input type="number" name="stok" id="stok" class="form-control @error('stok') is-invalid @enderror"
                value="{{ old('stok', $editing ? $produkTitipan->stok : '') }}" max="255"
                placeholder="Masukkan stok" required>
            @error('stok')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const hargaBeliInput = document.getElementById('harga_beli');
        const hargaJualInput = document.getElementById('harga_jual');

        hargaBeliInput.addEventListener('input', function() {
            const hargaBeli = parseFloat(hargaBeliInput.value);
            if (!isNaN(hargaBeli)) {
                // Hitung harga jual
                let hargaJual = hargaBeli + (hargaBeli *
                    0.7); // Harga jual = harga beli + 70% dari harga beli
                hargaJual = Math.floor(hargaJual / 500) *
                    500; // Bulatkan ke kelipatan 500 yang terkecil

                // Tampilkan harga jual pada input harga jual
                hargaJualInput.value = hargaJual; // Tidak perlu lagi menggunakan toFixed(2)
            }
        });
    });
</script>
