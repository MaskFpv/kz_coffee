@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card p-5">
            <h4 class="card-title">
                <a href="{{ route('employees.index') }}" class="mr-4"><i class="icon ion-md-arrow-back"></i></a>
                @lang('crud.karyawan.show_title')
            </h4>
            <div class="card-body">

                <div class="row">
                    <div class="col-md-5">
                        <div class="mb-4">
                            <h5>@lang('crud.karyawan.inputs.photo')</h5>
                            <x-partials.thumbnail src="{{ $employee->photo ? \Storage::url($employee->photo) : '' }}"
                                size="150" />
                        </div>
                        <div class="mb-4">
                            <h5>@lang('crud.karyawan.inputs.nama')</h5>
                            <span>{{ $employee->nama ?? '-' }}</span>
                        </div>
                        <div class="mb-4">
                            <h5>@lang('crud.karyawan.inputs.nip')</h5>
                            <span>{{ $employee->nip ?? '-' }}</span>
                        </div>
                        <div class="mb-4">
                            <h5>@lang('crud.karyawan.inputs.nik')</h5>
                            <span>{{ $employee->nik ?? '-' }}</span>
                        </div>
                        <div class="mb-4">
                            <h5>@lang('crud.karyawan.inputs.jenis_kelamin')</h5>
                            <span>{{ $employee->jenis_kelamin ?? '-' }}</span>
                        </div>
                    </div>
                    <div class="col-md-6">

                        <div class="mb-4">
                            <h5>@lang('crud.karyawan.inputs.tempat_lahir')</h5>
                            <span>{{ $employee->tempat_lahir ?? '-' }}</span>
                        </div>
                        <div class="mb-4">
                            <h5>@lang('crud.karyawan.inputs.tanggal_lahir')</h5>
                            <span>{{ optional($employee->tanggal_lahir)->format('Y-m-d') ?? '-' }}</span>
                        </div>
                        <div class="mb-4">
                            <h5>@lang('crud.karyawan.inputs.telepon')</h5>
                            <span>{{ $employee->telepon ?? '-' }}</span>
                        </div>
                        <div class="mb-4">
                            <h5>@lang('crud.karyawan.inputs.agama')</h5>
                            <span>{{ $employee->agama ?? '-' }}</span>
                        </div>
                        <div class="mb-4">
                            <h5>@lang('crud.karyawan.inputs.status_nikah')</h5>
                            <span>{{ $employee->status_nikah ?? '-' }}</span>
                        </div>
                        <div class="mb-4">
                            <h5>@lang('crud.karyawan.inputs.alamat')</h5>
                            <span>{{ $employee->alamat ?? '-' }}</span>
                        </div>
                    </div>
                </div>

                <div class="mt-4">
                    <a href="{{ route('employees.index') }}" class="btn btn-light">
                        <i class="icon ion-md-return-left"></i>
                        @lang('crud.common.back')
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
