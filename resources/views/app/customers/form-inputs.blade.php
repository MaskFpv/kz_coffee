@php $editing = isset($customer) @endphp

<div class="row">
    <div class="col-sm-12">
        <label for="nama" class="form-label">Nama</label>
        <input type="text" name="nama" id="nama" class="form-control @error('nama') is-invalid @enderror"
            value="{{ old('nama', $editing ? $customer->nama : '') }}" maxlength="255"
            placeholder="Masukkan nama pelanggan" required>
        @error('nama')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-sm-12 mt-2">
        <label for="email" class="form-label">Email</label>
        <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror"
            value="{{ old('email', $editing ? $customer->email : '') }}" maxlength="255"
            placeholder="Masukkan email pelanggan" required>
        @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-sm-12 mt-2">
        <label for="alamat" class="form-label">Alamat</label>
        <textarea name="alamat" id="alamat" class="form-control @error('alamat') is-invalid @enderror" maxlength="255"
            placeholder="Masukkan alamat pelanggan" required>{{ old('alamat', $editing ? $customer->alamat : '') }}</textarea>
        @error('alamat')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>
