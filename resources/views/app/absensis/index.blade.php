@extends('layouts.app')

@section('content')
    <div class="container">
        @if ($errors->any())
            <div id="error-message" class="alert alert-danger">
                {{ $errors->first() }}
            </div>
        @endif
        <div class="card">
            <div class="card-body">
                <div class="searchbar mt-4 mb-5">
                    <div class="row">
                        <div class="col-md-4">
                            <div style="display: flex; justify-content: space-between;">
                                <h4 class="card-title">@lang('crud.absensis.index_title')</h4>
                            </div>
                        </div>
                        <div class="col-md-8 text-right">
                            <button type="button" id="export-pdf-btn" class="btn btn-danger">
                                <a href="{{ route('absensi-exportPdf') }}" style="text-decoration: none; color:azure;"><i
                                        class="bi bi-file-earmark-pdf"></i>
                                    Export PDF</a>
                            </button>
                            <button type="button" id="export-pdf-btn" class="btn btn-success">
                                <a href="{{ route('absensi-export') }}" style="text-decoration: none; color:azure;"><i
                                        class="bi bi-file-earmark-excel"></i>
                                    Export XLS</a>
                            </button>
                            <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                data-bs-target="#importModal">
                                <i class="bi bi-file-earmark-plus"></i> Import XLS
                            </button>
                            <button type="button" class="btn btn-success">
                                <a href="https://drive.google.com/drive/folders/1Y3yNzFnTTTYboHr_6X4n0Sc06-MTL_JF"
                                    target="_blank" style="text-decoration: none; color:azure;">
                                    <i class="bi bi-file-earmark-excel"></i> Format Excel
                                </a>
                            </button>

                            @can('create', App\Models\Absensi::class)
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-mode="create"
                                    data-bs-target="#absensiModal"><i class="icon ion-md-add"></i>
                                    Create
                                </button>
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
                                                <button type="button" class="btn btn-light edit-btn" data-bs-toggle="modal"
                                                    data-mode="edit" data-bs-target="#absensiModal"
                                                    data-id="{{ $absensi->id }}"
                                                    data-nama_karyawan="{{ $absensi->nama_karyawan }}"
                                                    data-tanggal_masuk="{{ $absensi->tanggal_masuk }}"
                                                    data-waktu_masuk="{{ $absensi->waktu_masuk }}"
                                                    data-status="{{ $absensi->status }}"
                                                    data-waktu_keluar="{{ $absensi->waktu_keluar }}">
                                                    <i class="icon ion-md-create"></i>
                                                </button>
                                                @endcan @can('delete', $absensi)
                                                <form action="{{ route('absensis.destroy', $absensi) }}" method="POST">
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
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @include('app.absensis.form-inputs')
    @include('app.absensis.form-edit')

    {{-- Modal unutk import nya --}}
    <div class="modal fade" id="importModal" tabindex="-1" aria-labelledby="importModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="importModalLabel">Import File XLS</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Form untuk mengunggah file -->
                    <form action="{{ route('absensi-import') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="file" class="form-label">Pilih File XLS:</label>
                            <input type="file" class="form-control" id="file" name="file" accept=".xls,.xlsx"
                                required>
                        </div>
                        <button type="submit" class="btn btn-primary">Import</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $('#absensiModal').on('show.bs.modal', function(e) {
            const btn = $(e.relatedTarget);
            console.log(btn.data('mode'));
            const mode = btn.data('mode');
            const nama_karyawan = btn.data('nama_karyawan');
            const id = btn.data('id');
            const modal = $(this);
            console.log(id)
            console.log(mode)
            if (mode === 'edit') {
                modal.find('.modal-title').text('Edit Data absensi');
                modal.find('#nama_karyawan').val(nama_absensi);
                modal.find('#tanggal_masuk').val(tanggal_masuk);
                modal.find('#waktu_masuk').val(waktu_masuk);
                modal.find('#status').val(status);
                modal.find('#waktu_keluar').val(waktu_keluar);
                modal.find('.modal-body form').attr('action', '{{ url('absensis') }}/' + id)
                modal.find('#method').html('@method('PUT')');

            } else {
                modal.find('.modal-title').text('Input Data absensi');
                modal.find('#nama_karyawan').val('');
                modal.find('#tanggal_masuk').val('');
                modal.find('#waktu_masuk').val('');
                modal.find('#status').val('');
                modal.find('#waktu_keluar').val('');
                modal.find('#method').html('');
                modal.find('.modal-body form').attr('action', '{{ url('absensis') }}');

            }
        });

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
        $('.btn-delete').on('click', function(e) {
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
