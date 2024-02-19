@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{ route('types.index') }}" class="mr-4"
                    ><i class="icon ion-md-arrow-back"></i
                ></a>
                @lang('crud.jenis.show_title')
            </h4>

            <div class="mt-4">
                <div class="mb-4">
                    <h5>@lang('crud.jenis.inputs.nama_jenis')</h5>
                    <span>{{ $type->nama_jenis ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.jenis.inputs.category_id')</h5>
                    <span>{{ optional($type->category)->nama ?? '-' }}</span>
                </div>
            </div>

            <div class="mt-4">
                <a href="{{ route('types.index') }}" class="btn btn-light">
                    <i class="icon ion-md-return-left"></i>
                    @lang('crud.common.back')
                </a>

                @can('create', App\Models\Type::class)
                <a href="{{ route('types.create') }}" class="btn btn-light">
                    <i class="icon ion-md-add"></i> @lang('crud.common.create')
                </a>
                @endcan
            </div>
        </div>
    </div>
</div>
@endsection
