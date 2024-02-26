@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card p-4">
            <h4 class="card-title">
                <a href="{{ route('menus.index') }}" class="mr-4"><i class="icon ion-md-arrow-back"></i></a>
                @lang('crud.menu.show_title')
            </h4>
            <div class="card-body">

                <div class="row">
                    <!-- Kolom untuk foto dan nama menu -->
                    <div class="col-md-5">
                        <div class="mb-4">
                            <h4>@lang('crud.menu.inputs.photo')</h4>
                            <x-partials.thumbnail src="{{ $menu->photo ? \Storage::url($menu->photo) : '' }}"
                                size="150" />
                        </div>
                        <div class="mb-4">
                            <h5>{{ $menu->nama ?? '-' }}</h5>
                        </div>
                    </div>
                    <!-- Kolom untuk jenis dan harga -->
                    <div class="col-md-6">
                        <div class="mb-4">
                            <h4>@lang('crud.menu.inputs.type_id')</h4>
                            <span>{{ optional($menu->type)->nama_jenis ?? '-' }}</span>
                        </div>
                        <div class="mb-4">
                            <h4>@lang('crud.menu.inputs.harga')</h4>
                            <span>Rp. {{ isset($menu->harga) ? number_format($menu->harga, 0, ',', '.') : '-' }}</span>
                        </div>
                    </div>
                </div>

                <div class="mt-4">
                    <a href="{{ route('menus.index') }}" class="btn btn-light">
                        <i class="icon ion-md-return-left"></i>
                        @lang('crud.common.back')
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
