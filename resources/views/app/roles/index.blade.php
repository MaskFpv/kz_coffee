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
                            <h4 class="card-title">@lang('crud.roles.index_title')</h4>
                        </div>
                        <div class="col-md-6 text-right">
                            @can('create', App\Models\Role::class)
                                <a href="{{ route('roles.create') }}" class="btn btn-primary" style="width: 100px">
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
                                    @lang('crud.roles.inputs.name')
                                </th>
                                <th class="text-center">
                                    @lang('crud.common.actions')
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($roles as $role)
                                <tr>
                                    <td>{{ $role->name ?? '-' }}</td>
                                    <td class="text-center" style="width: 134px;">
                                        <div role="group" aria-label="Row Actions" class="btn-group">
                                            @can('update', $role)
                                                <a href="{{ route('roles.edit', $role) }}">
                                                    <button type="button" class="btn btn-light">
                                                        <i class="icon ion-md-create"></i>
                                                    </button>
                                                </a>
                                                @endcan @can('delete', $role)
                                                <form action="{{ route('roles.destroy', $role) }}" method="POST">
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
                                    <td colspan="2">
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
    </script>
@endpush
