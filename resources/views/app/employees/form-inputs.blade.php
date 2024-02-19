@php $editing = isset($employee) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12">
        <div x-data="imageViewer('{{ $editing && $employee->photo ? \Storage::url($employee->photo) : '' }}')">
            <x-inputs.partials.label name="photo" label="Foto Karyawan"></x-inputs.partials.label><br />

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
        <x-inputs.text name="nip" label="NIP" :value="old('nip', $editing ? $employee->nip : '')" maxlength="255" placeholder="Masukkan no NIP"
            required></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text name="nik" label="NIK" :value="old('nik', $editing ? $employee->nik : '')" maxlength="255" placeholder="Masukkan no NIK"
            required></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text name="nama" label="Nama" :value="old('nama', $editing ? $employee->nama : '')" maxlength="255"
            placeholder="Masukkan nama karyawan" required></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="jenis_kelamin" label="Jenis Kelamin">
            @php $selected = old('jenis_kelamin', ($editing ? $employee->jenis_kelamin : '')) @endphp
            <option value="laki_laki" {{ $selected == 'laki_laki' ? 'selected' : '' }}>Laki laki</option>
            <option value="perempuan" {{ $selected == 'perempuan' ? 'selected' : '' }}>Perempuan</option>
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text name="tempat_lahir" label="Tempat Lahir" :value="old('tempat_lahir', $editing ? $employee->tempat_lahir : '')" maxlength="255"
            placeholder="Tempat Lahir" required></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.date name="tanggal_lahir" label="Tanggal Lahir"
            value="{{ old('tanggal_lahir', $editing ? optional($employee->tanggal_lahir)->format('Y-m-d') : '') }}"
            max="255" required></x-inputs.date>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text name="telepon" label="Telepon" :value="old('telepon', $editing ? $employee->telepon : '')" maxlength="255" placeholder="No Telepon"
            required></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text name="agama" label="Agama" :value="old('agama', $editing ? $employee->agama : '')" maxlength="255" placeholder="Agama"
            required></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="status_nikah" label="Status Nikah">
            @php $selected = old('status_nikah', ($editing ? $employee->status_nikah : '')) @endphp
            <option value="belum_nikah" {{ $selected == 'belum_nikah' ? 'selected' : '' }}>Belum nikah</option>
            <option value="nikah" {{ $selected == 'nikah' ? 'selected' : '' }}>Nikah</option>
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.textarea name="alamat" label="Alamat" maxlength="255"
            required>{{ old('alamat', $editing ? $employee->alamat : '') }}</x-inputs.textarea>
    </x-inputs.group>

</div>
