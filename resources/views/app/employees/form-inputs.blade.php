@php $editing = isset($employee) @endphp

<div class="row">
    <div class="col-sm-12 ">
        <label for="photo" class="form-label">Foto Karyawan</label><br />

        <div class="mt-2">
            <input type="file" name="photo" id="photo" class="form-control @error('photo') is-invalid @enderror"
                @change="fileChosen" />
        </div>

        @error('photo')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-sm-12 mt-3">
        <label for="nip" class="form-label">NIP</label>
        <input type="text" name="nip" id="nip" class="form-control @error('nip') is-invalid @enderror"
            value="{{ old('nip', $editing ? $employee->nip : '') }}" maxlength="255" placeholder="Masukkan no NIP"
            required>
        @error('nip')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-sm-12 mt-3">
        <label for="nik" class="form-label">NIK</label>
        <input type="text" name="nik" id="nik" class="form-control @error('nik') is-invalid @enderror"
            value="{{ old('nik', $editing ? $employee->nik : '') }}" maxlength="255" placeholder="Masukkan no NIK"
            required>
        @error('nik')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-sm-12 mt-3">
        <label for="nama" class="form-label">Nama</label>
        <input type="text" name="nama" id="nama" class="form-control @error('nama') is-invalid @enderror"
            value="{{ old('nama', $editing ? $employee->nama : '') }}" maxlength="255"
            placeholder="Masukkan nama karyawan" required>
        @error('nama')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-sm-12 mt-3">
        <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
        <select name="jenis_kelamin" id="jenis_kelamin" class="form-select @error('jenis_kelamin') is-invalid @enderror"
            required>
            <option value="" disabled selected>Pilih Jenis Kelamin</option>
            <option value="laki_laki"
                {{ old('jenis_kelamin', $editing ? $employee->jenis_kelamin : '') == 'laki_laki' ? 'selected' : '' }}>
                Laki-laki</option>
            <option value="perempuan"
                {{ old('jenis_kelamin', $editing ? $employee->jenis_kelamin : '') == 'perempuan' ? 'selected' : '' }}>
                Perempuan</option>
        </select>
        @error('jenis_kelamin')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-sm-12 mt-3">
        <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
        <input type="text" name="tempat_lahir" id="tempat_lahir"
            class="form-control @error('tempat_lahir') is-invalid @enderror"
            value="{{ old('tempat_lahir', $editing ? $employee->tempat_lahir : '') }}" maxlength="255"
            placeholder="Tempat Lahir" required>
        @error('tempat_lahir')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-sm-12 mt-3">
        <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
        <input type="date" name="tanggal_lahir" id="tanggal_lahir"
            class="form-control @error('tanggal_lahir') is-invalid @enderror"
            value="{{ old('tanggal_lahir', $editing ? optional($employee->tanggal_lahir)->format('Y-m-d') : '') }}"
            required>
        @error('tanggal_lahir')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-sm-12 mt-3">
        <label for="telepon" class="form-label">Telepon</label>
        <input type="text" name="telepon" id="telepon" class="form-control @error('telepon') is-invalid @enderror"
            value="{{ old('telepon', $editing ? $employee->telepon : '') }}" maxlength="255" placeholder="No Telepon"
            required>
        @error('telepon')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-sm-12 mt-3">
        <label for="agama" class="form-label">Agama</label>
        <input type="text" name="agama" id="agama" class="form-control @error('agama') is-invalid @enderror"
            value="{{ old('agama', $editing ? $employee->agama : '') }}" maxlength="255" placeholder="Agama" required>
        @error('agama')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-sm-12 mt-3">
        <label for="status_nikah" class="form-label">Status Nikah</label>
        <select name="status_nikah" id="status_nikah" class="form-select @error('status_nikah') is-invalid @enderror"
            required>
            <option value="" disabled selected>Pilih Status Nikah</option>
            <option value="belum_nikah"
                {{ old('status_nikah', $editing ? $employee->status_nikah : '') == 'belum_nikah' ? 'selected' : '' }}>
                Belum Nikah</option>
            <option value="nikah"
                {{ old('status_nikah', $editing ? $employee->status_nikah : '') == 'nikah' ? 'selected' : '' }}>Nikah
            </option>
        </select>
        @error('status_nikah')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-sm-12 mt-3">
        <label for="alamat" class="form-label">Alamat</label>
        <textarea name="alamat" id="alamat" class="form-control @error('alamat') is-invalid @enderror" maxlength="255"
            placeholder="Alamat" required>{{ old('alamat', $editing ? $employee->alamat : '') }}</textarea>
        @error('alamat')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>
