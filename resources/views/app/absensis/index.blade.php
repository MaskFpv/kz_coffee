@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <div class="searchbar mt-4 mb-5">
                    <div class="row">
                        <div class="col-md-6">
                            <div style="display: flex; justify-content: space-between;">
                                <h4 class="card-title">@lang('crud.absensis.index_title')</h4>
                            </div>
                        </div>
                        <div class="col-md-6 text-right">
                            @can('create', App\Models\Absensi::class)
                                <a href="{{ route('absensis.create') }}" class="btn btn-primary">
                                    <i class="icon ion-md-add"></i> @lang('crud.common.create')
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
                                    @lang('crud.absensis.inputs.nama_karyawan')
                                </th>
                                <th class="text-left">
                                    @lang('crud.absensis.inputs.tanggal_masuk')
                                </th>
                                <th class="text-left">
                                    @lang('crud.absensis.inputs.waktu_masuk')
                                </th>
                                <th class="text-left">
                                    @lang('crud.absensis.inputs.status')
                                </th>
                                <th class="text-left">
                                    @lang('crud.absensis.inputs.waktu_keluar')
                                </th>
                                <th class="text-center">
                                    @lang('crud.common.actions')
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($absensis as $absensi)
                                <tr>
                                    <td>{{ $absensi->nama_karyawan ?? '-' }}</td>
                                    <td>{{ $absensi->tanggal_masuk ?? '-' }}</td>
                                    <td>{{ $absensi->waktu_masuk ?? '-' }}</td>
                                    <td>{{ $absensi->status ?? '-' }}</td>
                                    <td>{{ $absensi->waktu_keluar ?? '-' }}</td>
                                    <td class="text-center" style="width: 134px;">
                                        <div role="group" aria-label="Row Actions" class="btn-group">
                                            @can('update', $absensi)
                                                <a href="{{ route('absensis.edit', $absensi) }}">
                                                    <button type="button" class="btn btn-light">
                                                        <i class="icon ion-md-create"></i>
                                                    </button>
                                                </a>
                                                @endcan @can('delete', $absensi)
                                                <form action="{{ route('absensis.destroy', $absensi) }}" method="POST">
                                                    @csrf @method('DELETE')
                                                    <button type="button" class="btn btn-light text-danger">
                                                        <i class="icon ion-md-trash"></i>
                                                    </button>
                                                </form>
                                            @endcan
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6">
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
        // Ambil elemen pesan error
        var errorMessage = document.getElementById('error-message');

        // Jika pesan error ada, atur waktu untuk fade out setelah 5 detik
        if (errorMessage) {
            setTimeout(function() {
                errorMessage.style.transition = "opacity 1s";
                errorMessage.style.opacity = "0";
                setTimeout(function() {
                    errorMessage.remove(); // Hapus elemen pesan error dari DOM setelah fade out
                }, 1000);
            }, 5000); // Atur waktu fade out menjadi 5 detik (5000 milidetik)
        }

        // Sweet alert
        $('.btn').on('click', function(e) {
            let nama_produk = $(this).closest('tr').find('td:eq(0)').text();
            Swal.fire({
                icon: 'error',
                title: 'Hapus Data',
                html: 'Apakah Yakin data Absensi ini akan dihapus?',
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
