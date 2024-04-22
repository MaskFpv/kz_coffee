@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <div class="searchbar mt-4 mb-4">
                    <div class="row">
                        <div class="col-md-6">
                            <h4 class="card-title">@lang('crud.users.index_title')</h4>
                        </div>
                        <div class="col-md-6 text-right">
                            <button type="button" id="export-pdf-btn" class="btn btn-danger">
                                <a href="{{ route('user-exportPdf') }}" style="text-decoration: none; color:azure;"><i
                                        class="bi bi-file-earmark-pdf"></i>
                                    Export PDF</a>
                            </button>
                            <button type="button" id="export-pdf-btn" class="btn btn-success">
                                <a href="{{ route('user-export') }}" style="text-decoration: none; color:azure;"><i
                                        class="bi bi-file-earmark-excel"></i>
                                    Export XLS</a>
                            </button>
                            @can('create', App\Models\User::class)
                                <a href="{{ route('users.create') }}" class="btn btn-primary" style="width: 100px">
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
                                    @lang('crud.users.inputs.name')
                                </th>
                                <th class="text-left">
                                    @lang('crud.users.inputs.email')
                                </th>
                                <th class="text-center">
                                    @lang('crud.common.actions')
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($users as $user)
                                <tr>
                                    <td>{{ $user->name ?? '-' }}</td>
                                    <td>{{ $user->email ?? '-' }}</td>
                                    <td class="text-center" style="width: 134px;">
                                        <div role="group" aria-label="Row Actions" class="btn-group">
                                            @can('update', $user)
                                                <a href="{{ route('users.edit', $user) }}">
                                                    <button type="button" class="btn btn-light">
                                                        <i class="icon ion-md-create"></i>
                                                    </button>
                                                </a>
                                                @endcan @can('view', $user)
                                                <a href="{{ route('users.show', $user) }}">
                                                    <button type="button" class="btn btn-light">
                                                        <i class="icon ion-md-eye"></i>
                                                    </button>
                                                </a>
                                                @endcan @can('delete', $user)
                                                <form action="{{ route('users.destroy', $user) }}" method="POST">
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
                                    <td colspan="3">
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
                html: 'Apakah Yakin data User ini akan dihapus?',
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
