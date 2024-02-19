@php $editing = isset($menu) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12">
        <div x-data="imageViewer('{{ $editing && $menu->photo ? \Storage::url($menu->photo) : '' }}')">
            <x-inputs.partials.label name="photo" label="Foto Menu"></x-inputs.partials.label><br />

            <!-- Show the image -->
            <template x-if="imageUrl">
                <img :src="imageUrl" class="object-cover rounded border border-gray-200"
                    style="width: 100px; height: 100px;" />
            </template>

            <!-- Show the gray box when image is not available -->
            <template x-if="!imageUrl">
                <div class="border rounded border-gray-200 bg-gray-100" style="width: 100px; height: 100px;"></div>
            </template>

            <div class="mt-2">
                <input type="file" name="photo" id="photo" @change="fileChosen" />
            </div>

            @error('photo')
                @include('components.inputs.partials.error')
            @enderror
        </div>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text name="nama" label="Nama Menu" :value="old('nama', $editing ? $menu->nama : '')" maxlength="255"
            placeholder="Masukkan nama menu baru" required></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="type_id" label="Jenis" required>
            @php $selected = old('type_id', ($editing ? $menu->type_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Pilih jenis menu</option>
            @foreach ($types as $value => $label)
                <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }}>{{ $label }}
                </option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.number name="harga" label="Harga" :value="old('harga', $editing ? $menu->harga : '')" step="0.01"
            placeholder="Masukkan harga menu" required></x-inputs.number>
    </x-inputs.group>


</div>
