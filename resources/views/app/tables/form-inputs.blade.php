@php $editing = isset($table); @endphp

<div class="row">
    <div class="col-sm-12">
        <label for="nomor_meja" class="form-label">Nomor Meja</label>
        <input type="number" name="nomor_meja" id="nomor_meja" class="form-control"
            value="{{ old('nomor_meja', $editing ? $table->nomor_meja : '') }}" max="255" placeholder="Nomor Meja"
            required>
    </div>

    <div class="col-sm-12 mt-3">
        <label for="kapasitas" class="form-label">Kapasitas</label>
        <input type="number" name="kapasitas" id="kapasitas" class="form-control"
            value="{{ old('kapasitas', $editing ? $table->kapasitas : '') }}" max="255"
            placeholder="Kapasitas meja" required>
    </div>

    <div class="col-sm-12 mt-3">
        <label for="status" class="form-label">Status</label>
        <select name="status" id="status" class="form-select" required>
            @php $selected = old('status', ($editing ? $table->status : '')) @endphp
            <option value="terpakai" {{ $selected == 'terpakai' ? 'selected' : '' }}>Terpakai</option>
            <option value="tersedia" {{ $selected == 'tersedia' ? 'selected' : '' }}>Tersedia</option>
        </select>
    </div>
</div>
