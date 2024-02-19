@php $editing = isset($stock) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12">
        <x-inputs.number name="jumlah" label="Stok" :value="old('jumlah', $editing ? $stock->jumlah : '')" max="255"
            placeholder="Masukkan stok menu yang tersedia" required></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="menu_id" label="Menu" required>
            @php $selected = old('menu_id', ($editing ? $stock->menu_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Pilih menu</option>
            @foreach ($menus as $value => $label)
                <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }}>{{ $label }}
                </option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>
</div>
