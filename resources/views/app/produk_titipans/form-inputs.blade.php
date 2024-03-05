@php $editing = isset($produkTitipan) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12">
        <x-inputs.text name="nama_produk" label="Nama Produk" :value="old('nama_produk', $editing ? $produkTitipan->nama_produk : '')" maxlength="255"
            placeholder="Masukan nama produk" required></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text name="nama_supplier" label="Nama Supplier" :value="old('nama_supplier', $editing ? $produkTitipan->nama_supplier : '')" maxlength="255"
            placeholder="Masukkan nama supplier" required></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.number name="harga_beli" label="Harga Beli" :value="old('harga_beli', $editing ? $produkTitipan->harga_beli : '')" step="0.01" placeholder="Harga beli"
            required></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.number name="harga_jual" label="Harga Jual" :value="old('harga_jual', $editing ? $produkTitipan->harga_jual : '')" step="0.01" placeholder="Harga jual"
            required></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.number name="stok" label="Stok" :value="old('stok', $editing ? $produkTitipan->stok : '')" max="255" placeholder="Masukkan stok"
            required></x-inputs.number>
    </x-inputs.group>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const hargaBeliInput = document.getElementById('harga_beli');
        const hargaJualInput = document.getElementById('harga_jual');

        hargaBeliInput.addEventListener('input', function() {
            const hargaBeli = parseFloat(hargaBeliInput.value);
            if (!isNaN(hargaBeli)) {
                // Hitung harga jual
                const keuntungan = hargaBeli * 0.7;
                let hargaJual = Math.ceil((hargaBeli + keuntungan) / 500) * 500;

                // Jika harga jual merupakan bilangan bulat, hilangkan angka desimal
                if (hargaJual % 1 === 0) {
                    hargaJual = Math.floor(hargaJual);
                }

                // Tampilkan harga jual pada input harga jual
                hargaJualInput.value = hargaJual;
            }
        });
    });
</script>
