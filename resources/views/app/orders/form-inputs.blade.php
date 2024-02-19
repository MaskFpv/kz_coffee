@php $editing = isset($order) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12">
        <x-inputs.number name="jumlah_pelanggan" label="Jumlah Pelanggan" :value="old('jumlah_pelanggan', $editing ? $order->jumlah_pelanggan : '')" max="255"
            placeholder="Jumlah Pelanggan" required></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="customer_id" label="Customer" required>
            @php $selected = old('customer_id', ($editing ? $order->customer_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Pilih Pelanggan</option>
            @foreach ($customers as $value => $label)
                <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }}>{{ $label }}
                </option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text name="nama_pemesan" label="Nama Pemesan" :value="old('nama_pemesan', $editing ? $order->nama_pemesan : '')" maxlength="255"
            placeholder="Nama Pemesan" required></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="table_id" label="Table" required>
            @php $selected = old('table_id', ($editing ? $order->table_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Pilih Meja</option>
            @foreach ($tables as $value => $label)
                <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }}>{{ $label }}
                </option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.datetime name="hari_pesan" label="Hari Pesan"
            value="{{ old('hari_pesan', $editing ? optional($order->hari_pesan)->format('Y-m-d\TH:i:s') : '') }}"
            max="255" required></x-inputs.datetime>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="status" label="Status">
            @php $selected = old('status', ($editing ? $order->status : '0')) @endphp
            <option value="di_proses" {{ $selected == 'di_proses' ? 'selected' : '' }}>Di proses</option>
            <option value="selesai" {{ $selected == 'selesai' ? 'selected' : '' }}>Selesai</option>
        </x-inputs.select>
    </x-inputs.group>
</div>
