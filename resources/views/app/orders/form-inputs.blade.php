@php $editing = isset($order) @endphp

<div class="row">
    <div class="col-sm-12 mt-3">
        <label for="jumlah_pelanggan" class="form-label">Jumlah Pelanggan</label>
        <input type="number" name="jumlah_pelanggan" id="jumlah_pelanggan"
            class="form-control @error('jumlah_pelanggan') is-invalid @enderror"
            value="{{ old('jumlah_pelanggan', $editing ? $order->jumlah_pelanggan : '') }}" max="255"
            placeholder="Jumlah Pelanggan" required>
        @error('jumlah_pelanggan')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-sm-12 mt-3">
        <label for="customer_id" class="form-label">Customer</label>
        <select name="customer_id" id="customer_id" class="form-select @error('customer_id') is-invalid @enderror"
            required>
            <option value="" disabled
                {{ empty(old('customer_id', $editing ? $order->customer_id : '')) ? 'selected' : '' }}>Pilih Pelanggan
            </option>
            @foreach ($customers as $value => $label)
                <option value="{{ $value }}"
                    {{ old('customer_id', $editing ? $order->customer_id : '') == $value ? 'selected' : '' }}>
                    {{ $label }}</option>
            @endforeach
        </select>
        @error('customer_id')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-sm-12 mt-3">
        <label for="nama_pemesan" class="form-label">Nama Pemesan</label>
        <input type="text" name="nama_pemesan" id="nama_pemesan"
            class="form-control @error('nama_pemesan') is-invalid @enderror"
            value="{{ old('nama_pemesan', $editing ? $order->nama_pemesan : '') }}" maxlength="255"
            placeholder="Nama Pemesan" required>
        @error('nama_pemesan')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-sm-12 mt-3">
        <label for="table_id" class="form-label">Table</label>
        <select name="table_id" id="table_id" class="form-select @error('table_id') is-invalid @enderror" required>
            <option value="" disabled
                {{ empty(old('table_id', $editing ? $order->table_id : '')) ? 'selected' : '' }}>Pilih Meja</option>
            @foreach ($tables as $value => $label)
                <option value="{{ $value }}"
                    {{ old('table_id', $editing ? $order->table_id : '') == $value ? 'selected' : '' }}>
                    {{ $label }}</option>
            @endforeach
        </select>
        @error('table_id')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-sm-12 mt-3">
        <label for="hari_pesan" class="form-label">Hari Pesan</label>
        <input type="datetime-local" name="hari_pesan" id="hari_pesan"
            class="form-control @error('hari_pesan') is-invalid @enderror"
            value="{{ old('hari_pesan', $editing ? optional($order->hari_pesan)->format('Y-m-d\TH:i:s') : '') }}"
            max="255" required>
        @error('hari_pesan')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-sm-12 mt-3">
        <label for="status" class="form-label">Status</label>
        <select name="status" id="status" class="form-select @error('status') is-invalid @enderror" required>
            <option value="di_proses"
                {{ old('status', $editing ? $order->status : '0') == 'di_proses' ? 'selected' : '' }}>Di proses
            </option>
            <option value="selesai"
                {{ old('status', $editing ? $order->status : '0') == 'selesai' ? 'selected' : '' }}>Selesai</option>
        </select>
        @error('status')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>
