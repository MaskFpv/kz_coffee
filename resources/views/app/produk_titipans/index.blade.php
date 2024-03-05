@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="card">
            <div class="card-body">
                <div class="searchbar mt-4 mb-4">
                    <div class="row">
                        <div class="col-md-6">
                            <h4 class="card-title">
                                @lang('crud.produk_titipan.index_title')
                            </h4>
                        </div>
                        <div class="col-md-6 text-right">
                            @can('create', App\Models\ProdukTitipan::class)
                                <a href="{{ route('produk-titipans.create') }}" class="btn btn-primary">
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
                                    @lang('crud.produk_titipan.inputs.nama_produk')
                                </th>
                                <th class="text-left">
                                    @lang('crud.produk_titipan.inputs.nama_supplier')
                                </th>
                                <th class="text-right">
                                    @lang('crud.produk_titipan.inputs.harga_beli')
                                </th>
                                <th class="text-right">
                                    @lang('crud.produk_titipan.inputs.harga_jual')
                                </th>
                                <th class="text-right">
                                    @lang('crud.produk_titipan.inputs.stok')
                                </th>
                                <th class="text-center">
                                    @lang('crud.common.actions')
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($produkTitipans as $produkTitipan)
                                <tr>
                                    <td>{{ $produkTitipan->nama_produk ?? '-' }}</td>
                                    <td>{{ $produkTitipan->nama_supplier ?? '-' }}</td>
                                    <td>{{ $produkTitipan->harga_beli ?? '-' }}</td>
                                    <td>{{ $produkTitipan->harga_jual ?? '-' }}</td>
                                    <td>{{ $produkTitipan->stok ?? '-' }}</td>
                                    <td class="text-center" style="width: 134px;">
                                        <div role="group" aria-label="Row Actions" class="btn-group">
                                            @can('update', $produkTitipan)
                                                <a href="{{ route('produk-titipans.edit', $produkTitipan) }}">
                                                    <button type="button" class="btn btn-light">
                                                        <i class="icon ion-md-create"></i>
                                                    </button>
                                                </a>
                                                @endcan @can('view', $produkTitipan)
                                                <a href="{{ route('produk-titipans.show', $produkTitipan) }}">
                                                    <button type="button" class="btn btn-light">
                                                        <i class="icon ion-md-eye"></i>
                                                    </button>
                                                </a>
                                                @endcan @can('delete', $produkTitipan)
                                                <form action="{{ route('produk-titipans.destroy', $produkTitipan) }}"
                                                    method="POST"
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
                                    <td colspan="6">
                                        @lang('crud.common.no_items_found')
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="6">
                                    {!! $produkTitipans->render() !!}
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
