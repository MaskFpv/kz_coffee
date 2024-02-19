@php $editing = isset($type) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12">
        <x-inputs.text name="nama_jenis" label="Nama Jenis" :value="old('nama_jenis', $editing ? $type->nama_jenis : '')" maxlength="255" placeholder="Nama Jenis"
            required></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="category_id" label="Kategori" required>
            @php $selected = old('category_id', ($editing ? $type->category_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Pilih Kategori</option>
            @foreach ($categories as $value => $label)
                <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }}>{{ $label }}
                </option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>
</div>
