@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card p-4">
            <h4 class="card-title">
                <a href="{{ route('employees.index') }}" class="mr-4"><i class="icon ion-md-arrow-back"></i></a>
                @lang('crud.karyawan.edit_title')
            </h4>
            <div class="card-body">

                <form method="PUT" action="{{ route('employees.update', $employee) }}" has-files class="mt-2">
                    @csrf

                    @include('app.employees.form-inputs')

                    <div class="mt-4">
                        <a href="{{ route('employees.index') }}" class="btn btn-light">
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
