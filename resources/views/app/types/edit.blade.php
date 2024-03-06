@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card p-4">
            <h4 class="card-title">
                <a href="{{ route('types.index') }}" class="mr-4"><i class="icon ion-md-arrow-back"></i></a>
                @lang('crud.jenis.edit_title')
            </h4>
            <div class="card-body">

                <form method="PUT" action="{{ route('types.update', $type) }}" class="mt-2">
                    @csrf

                    @include('app.types.form-inputs')

                    <div class="mt-4">
                        <a href="{{ route('types.index') }}" class="btn btn-light">
                            <i class="icon ion-md-return-left text-primary"></i>
                            @lang('crud.common.back')
                        </a>
                        <button type="submit" class="btn btn-primary float-right">
                            <i class="icon ion-md-save"></i>
                            @lang('crud.common.update')
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
