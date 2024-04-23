@php $editing = isset($absensi) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="nama_karyawan"
            label="Nama Karyawan"
            :value="old('nama_karyawan', ($editing ? $absensi->nama_karyawan : ''))"
            maxlength="255"
            placeholder="Nama Karyawan"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.date
            name="tanggal_masuk"
            label="Tanggal Masuk"
            value="{{ old('tanggal_masuk', ($editing ? optional($absensi->tanggal_masuk)->format('Y-m-d') : '')) }}"
            max="255"
            required
        ></x-inputs.date>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="waktu_masuk"
            label="Waktu Masuk"
            :value="old('waktu_masuk', ($editing ? $absensi->waktu_masuk : ''))"
            maxlength="255"
            placeholder="Waktu Masuk"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="status" label="Status">
            @php $selected = old('status', ($editing ? $absensi->status : '')) @endphp
            <option value="masuk" {{ $selected == 'masuk' ? 'selected' : '' }} >Masuk</option>
            <option value="sakit" {{ $selected == 'sakit' ? 'selected' : '' }} >Sakit</option>
            <option value="cuti" {{ $selected == 'cuti' ? 'selected' : '' }} >Cuti</option>
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="waktu_keluar"
            label="Waktu Keluar"
            :value="old('waktu_keluar', ($editing ? $absensi->waktu_keluar : ''))"
            maxlength="255"
            placeholder="Waktu Keluar"
            required
        ></x-inputs.text>
    </x-inputs.group>
</div>
