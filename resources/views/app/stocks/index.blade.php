@extends('layouts.app')

@section('content')
    <div class="container">
        @if (session('error'))
            <div id="error-message" class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <div class="card">
            <div class="card-body">
                <div class="searchbar mt-4 mb-5">
                    <div class="row">
                        <div class="col-md-6">
                            <h4 class="card-title">@lang('crud.stok.index_title')</h4>
                        </div>
                        <div class="col-md-6 text-right">
                            <button type="button" id="export-pdf-btn" class="btn btn-danger">
                                <a href="{{ route('stock-exportPdf') }}" style="text-decoration: none; color:azure;"><i
                                        class="bi bi-file-earmark-pdf"></i>
                                    Export PDF</a>
                            </button>
                            <button type="button" id="export-pdf-btn" class="btn btn-success">
                                <a href="{{ route('stock-export') }}" style="text-decoration: none; color:azure;"><i
                                        class="bi bi-file-earmark-excel"></i>
                                    Export XLS</a>
                            </button>
                            <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                data-bs-target="#importModal">
                                <i class="bi bi-file-earmark-plus"></i> Import XLS
                            </button>
                            @can('create', App\Models\Stock::class)
                                <a href="{{ route('stocks.create') }}" class="btn btn-primary" style="width: 100px">
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
                                    @lang('crud.stok.inputs.jumlah')
                                </th>
                                <th class="text-left">
                                    @lang('crud.stok.inputs.menu_id')
                                </th>
                                <th class="text-center">
                                    @lang('crud.common.actions')
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($stocks as $stock)
                                <tr>
                                    <td>{{ $stock->jumlah ?? '-' }}</td>
                                    <td>{{ optional($stock->menu)->nama ?? '-' }}</td>
                                    <td class="text-center" style="width: 134px;">
                                        <div role="group" aria-label="Row Actions" class="btn-group">
                                            @can('update', $stock)
                                                <a href="{{ route('stocks.edit', $stock) }}">
                                                    <button type="button" class="btn btn-light">
                                                        <i class="icon ion-md-create"></i>
                                                    </button>
                                                </a>
                                                @endcan @can('delete', $stock)
                                                <form action="{{ route('stocks.destroy', $stock) }}" method="POST">
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
                    <form action="{{ route('stock-import') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="file" class="form-label">Pilih File XLS:</label>
                            <input type="file" class="form-control" id="file" name="file" accept=".xls,.xlsx"
                                required>
                        </div>
                        <p>Tidak punya format nya? <a href="{{ asset('import/import-stok.xlsx') }}" download="">Download
                                Import
                                Excel</a></p>
                        <button type="submit" class="btn btn-primary">Import</button>
                    </form>
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
    </script>
@endpush
