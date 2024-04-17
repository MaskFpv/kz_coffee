@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <div class="searchbar mt-4 mb-4">
                    <div class="row">
                        <div class="col-md-6">
                            <h4 class="card-title">@lang('crud.karyawan.index_title')</h4>
                        </div>
                        <div class="col-md-6 text-right">
                            @can('create', App\Models\Employee::class)
                                <a href="{{ route('employees.create') }}" class="btn btn-primary">
                                    <i class="icon ion-md-add"></i>
                                    @lang('crud.common.create')
                                </a>
                            @endcan
                        </div>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-borderless table-hover" id="myTable">
                        <thead>
                            <tr>
                                <th class="text-left">
                                    @lang('crud.karyawan.inputs.nip')
                                </th>
                                <th class="text-left">
                                    @lang('crud.karyawan.inputs.nik')
                                </th>
                                <th class="text-left">
                                    @lang('crud.karyawan.inputs.nama')
                                </th>
                                <th class="text-left">
                                    @lang('crud.karyawan.inputs.jenis_kelamin')
                                </th>
                                <th class="text-left">
                                    @lang('crud.karyawan.inputs.tempat_lahir')
                                </th>
                                <th class="text-left">
                                    @lang('crud.karyawan.inputs.tanggal_lahir')
                                </th>
                                <th class="text-left">
                                    @lang('crud.karyawan.inputs.telepon')
                                </th>
                                <th class="text-left">
                                    @lang('crud.karyawan.inputs.agama')
                                </th>
                                <th class="text-left">
                                    @lang('crud.karyawan.inputs.status_nikah')
                                </th>
                                <th class="text-left">
                                    @lang('crud.karyawan.inputs.alamat')
                                </th>
                                <th class="text-left">
                                    @lang('crud.karyawan.inputs.photo')
                                </th>
                                <th class="text-center">
                                    @lang('crud.common.actions')
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($employees as $employee)
                                <tr>
                                    <td>{{ $employee->nip ?? '-' }}</td>
                                    <td>{{ $employee->nik ?? '-' }}</td>
                                    <td>{{ $employee->nama ?? '-' }}</td>
                                    <td>{{ $employee->jenis_kelamin ?? '-' }}</td>
                                    <td>{{ $employee->tempat_lahir ?? '-' }}</td>
                                    <td>{{ $employee->tanggal_lahir ?? '-' }}</td>
                                    <td>{{ $employee->telepon ?? '-' }}</td>
                                    <td>{{ $employee->agama ?? '-' }}</td>
                                    <td>{{ $employee->status_nikah ?? '-' }}</td>
                                    <td>{{ $employee->alamat ?? '-' }}</td>
                                    <td>
                                        <x-partials.thumbnail
                                            src="{{ $employee->photo ? \Storage::url($employee->photo) : '' }}" />
                                    </td>
                                    <td class="text-center" style="width: 134px;">
                                        <div role="group" aria-label="Row Actions" class="btn-group">
                                            @can('update', $employee)
                                                <a href="{{ route('employees.edit', $employee) }}">
                                                    <button type="button" class="btn btn-light">
                                                        <i class="icon ion-md-create"></i>
                                                    </button>
                                                </a>
                                                @endcan @can('view', $employee)
                                                <a href="{{ route('employees.show', $employee) }}">
                                                    <button type="button" class="btn btn-light">
                                                        <i class="icon ion-md-eye"></i>
                                                    </button>
                                                </a>
                                                @endcan @can('delete', $employee)
                                                <form action="{{ route('employees.destroy', $employee) }}" method="POST">
                                                    @csrf @method('DELETE')
                                                    <button type="button" class="btn btn-light text-danger btn-delete">
                                                        <i class="icon ion-md-trash"></i>
                                                    </button>
                                                </form>
                                            @endcan
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="12">
                                        @lang('crud.common.no_items_found')
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // Sweet alert
        $('.btn-delete').on('click', function(e) {
            let nama_produk = $(this).closest('tr').find('td:eq(0)').text();
            Swal.fire({
                icon: 'error',
                title: 'Hapus Data',
                html: 'Apakah Yakin data Karyawan ini akan dihapus?',
                showCancelButton: true,
                confirmButtonText: 'Ya',
                denyButtonText: 'Tidak',
                showDenyButon: true,
                focusConfirm: false
            }).then((result) => {
                if (result.isConfirmed) $(e.target).closest('form').submit()
                else swal.close()
            })
        })
    </script>
@endpush
