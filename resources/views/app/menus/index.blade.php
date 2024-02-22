@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <div class="searchbar mt-4 mb-5">
                    <div class="row">
                        <div class="col-md-6">
                            <h4 class="card-title">@lang('crud.menu.index_title')</h4>
                        </div>
                        <div class="col-md-6 text-right">
                            @can('create', App\Models\Menu::class)
                                <a href="{{ route('menus.create') }}" class="btn btn-primary">
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
                                    @lang('crud.menu.inputs.nama')
                                </th>
                                <th class="text-left">
                                    @lang('crud.menu.inputs.type_id')
                                </th>
                                <th class="text-left">
                                    @lang('crud.menu.inputs.harga')
                                </th>
                                <th class="text-left">
                                    @lang('crud.menu.inputs.photo')
                                </th>
                                <th class="text-center">
                                    @lang('crud.common.actions')
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($menus as $menu)
                                <tr>
                                    <td>{{ $menu->nama ?? '-' }}</td>
                                    <td>
                                        {{ optional($menu->type)->nama_jenis ?? '-' }}
                                    </td>
                                    <td>Rp. {{ $menu->harga ?? '-' }}</td>
                                    <td>
                                        <x-partials.thumbnail src="{{ $menu->photo ? \Storage::url($menu->photo) : '' }}" />
                                    </td>
                                    <td class="text-center" style="width: 134px;">
                                        <div role="group" aria-label="Row Actions" class="btn-group">
                                            @can('update', $menu)
                                                <a href="{{ route('menus.edit', $menu) }}">
                                                    <button type="button" class="btn btn-light">
                                                        <i class="icon ion-md-create"></i>
                                                    </button>
                                                </a>
                                                @endcan @can('view', $menu)
                                                <a href="{{ route('menus.show', $menu) }}">
                                                    <button type="button" class="btn btn-light">
                                                        <i class="icon ion-md-eye"></i>
                                                    </button>
                                                </a>
                                                @endcan @can('delete', $menu)
                                                <form action="{{ route('menus.destroy', $menu) }}" method="POST"
                                                    onsubmit="return confirm('{{ __('crud.common.are_you_sure') }}')">
                                                    @csrf @method('DELETE')
                                                    <button type="submit" class="btn btn-light text-danger">
                                                        <i class="icon ion-md-trash"></i>
                                                    </button>
                                                </form>
                                            @endcan
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5">
                                        @lang('crud.common.no_items_found')
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="5">{!! $menus->render() !!}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
