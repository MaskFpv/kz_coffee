@php $editing = isset($category) @endphp

<div class="row align-items-center">
    <x-inputs.group class="col-md-12">
        <x-inputs.text name="nama" label="Kategori" :value="old('nama', $editing ? $category->nama : '')" maxlength="255" placeholder="Masukkan Kategori"
            required></x-inputs.text>
    </x-inputs.group>
</div>
