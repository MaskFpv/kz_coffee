@php $editing = isset($menu) @endphp

<div class="row">
    <div class="col-sm-12">
        <label for="photo" class="form-label">Foto Menu</label><br />
        <div class="mt-2">
            <input type="file" name="photo" id="photo" class="form-control @error('photo') is-invalid @enderror"
                @change="fileChosen" />
        </div>

        @error('photo')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-sm-12 mt-3">
        <label for="nama" class="form-label">Nama Menu</label>
        <input type="text" name="nama" id="nama" class="form-control @error('nama') is-invalid @enderror"
            value="{{ old('nama', $editing ? $menu->nama : '') }}" maxlength="255" placeholder="Masukkan nama menu baru"
            required>
        @error('nama')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-sm-12 mt-3">
        <label for="type_id" class="form-label">Jenis</label>
        <select name="type_id" id="type_id" class="form-select @error('type_id') is-invalid @enderror" required>
            <option value="" disabled
                {{ empty(old('type_id', $editing ? $menu->type_id : '')) ? 'selected' : '' }}>Pilih jenis menu
            </option>
            @foreach ($types as $value => $label)
                <option value="{{ $value }}"
                    {{ old('type_id', $editing ? $menu->type_id : '') == $value ? 'selected' : '' }}>
                    {{ $label }}</option>
            @endforeach
        </select>
        @error('type_id')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-sm-12 mt-3">
        <label for="harga" class="form-label">Harga</label>
        <input type="number" name="harga" id="harga" class="form-control @error('harga') is-invalid @enderror"
            value="{{ old('harga', $editing ? $menu->harga : '') }}" step="0.01" placeholder="Masukkan harga menu"
            required>
        @error('harga')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>
