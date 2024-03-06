@php $editing = isset($type); @endphp

<div class="row">
    <div class="col-sm-12">
        <label for="nama_jenis" class="form-label">Nama Jenis</label>
        <input type="text" name="nama_jenis" id="nama_jenis" class="form-control"
            value="{{ old('nama_jenis', $editing ? $type->nama_jenis : '') }}" maxlength="255" placeholder="Nama Jenis"
            required>
    </div>

    <div class="col-sm-12 mt-3">
        <label for="category_id" class="form-label">Kategori</label>
        <select name="category_id" id="category_id" class="form-select" required>
            @php $selected = old('category_id', ($editing ? $type->category_id : '')) @endphp
            <option value="" disabled {{ empty($selected) ? 'selected' : '' }}>Pilih Kategori</option>
            @foreach ($categories as $value => $label)
                <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }}>{{ $label }}
                </option>
            @endforeach
        </select>
    </div>
</div>
