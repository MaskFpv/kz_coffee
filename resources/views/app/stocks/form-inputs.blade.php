@php $editing = isset($stock); @endphp

<div class="row">
    <div class="col-sm-12">
        <label for="jumlah" class="form-label">Stok</label>
        <input type="number" name="jumlah" id="jumlah" class="form-control"
            value="{{ old('jumlah', $editing ? $stock->jumlah : '') }}" max="255"
            placeholder="Masukkan stok menu yang tersedia" required>
    </div>

    <div class="col-sm-12 mt-3">
        <label for="menu_id" class="form-label">Menu</label>
        <select name="menu_id" id="menu_id" class="form-select" required>
            @php $selected = old('menu_id', ($editing ? $stock->menu_id : '')) @endphp
            <option value="" disabled {{ empty($selected) ? 'selected' : '' }}>Pilih menu</option>
            @foreach ($menus as $value => $label)
                <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }}>{{ $label }}
                </option>
            @endforeach
        </select>
    </div>
</div>
