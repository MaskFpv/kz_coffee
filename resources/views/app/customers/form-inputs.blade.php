@php $editing = isset($customer) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="nama"
            label="Nama"
            :value="old('nama', ($editing ? $customer->nama : ''))"
            maxlength="255"
            placeholder="Masukkan nama pelanggan"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.email
            name="email"
            label="Email"
            :value="old('email', ($editing ? $customer->email : ''))"
            maxlength="255"
            placeholder="Masukkan email pelanggan"
            required
        ></x-inputs.email>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.textarea name="alamat" label="Alamat" maxlength="255" required
            >{{ old('alamat', ($editing ? $customer->alamat : ''))
            }}</x-inputs.textarea
        >
    </x-inputs.group>
</div>
