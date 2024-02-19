@php $editing = isset($table) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12">
        <x-inputs.number name="nomor_meja" label="Nomor Meja" :value="old('nomor_meja', $editing ? $table->nomor_meja : '')" max="255" placeholder="Nomor Meja"
            required></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.number name="kapasitas" label="Kapasitas" :value="old('kapasitas', $editing ? $table->kapasitas : '')" max="255" placeholder="Kapasitas meja"
            required></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="status" label="Status">
            @php $selected = old('status', ($editing ? $table->status : '')) @endphp
            <option value="terpakai" {{ $selected == 'terpakai' ? 'selected' : '' }}>Terpakai</option>
            <option value="tersedia" {{ $selected == 'tersedia' ? 'selected' : '' }}>Tersedia</option>
        </x-inputs.select>
    </x-inputs.group>
</div>
