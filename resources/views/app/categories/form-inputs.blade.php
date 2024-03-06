@php $editing = isset($category) @endphp

<div class="row align-items-center">
    <div class="col-md-12">
        <label for="nama" class="form-label">Kategori</label>
        <input type="text" name="nama" id="nama" class="form-control @error('nama') is-invalid @enderror"
            value="{{ old('nama', $editing ? $category->nama : '') }}" maxlength="255" placeholder="Masukkan Kategori"
            required>
        @error('nama')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>
