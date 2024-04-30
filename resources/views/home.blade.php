@extends('layouts.app')

@section('content')
    <div class="container-fluid p-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Home') }}</div>

                    <div class="card-body text-center">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <p class="mb-2 fs-4 text-success">{{ __('You are logged in!') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


{{-- @extends('layouts.app')

@section('content')
    <div class="container-fluid pt-4 px-4">
        <div class="row ">
            <div class="col-md-4">
                <div class="bg-light rounded d-flex align-items-center p-4">
                    <i class="bi bi-graph-up text-primary px-2" style="font-size: 3rem; margin-right: 1em;"></i>
                    <div>
                        <p class="mb-2 fs-5 fw-semibold">Jumlah Transaksi</p>
                        <h6 class="mb-0 fs-6">$1234</h6>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="bg-light rounded d-flex align-items-center p-4">
                    <i class="bi bi-journals text-primary px-2" style="font-size: 3rem; margin-right: 1em;"></i>
                    <div>
                        <p class="mb-2 fs-5 fw-semibold">Jumlah Pendapatan</p>
                        <h6 class="mb-0 fs-6">$1234</h6>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="bg-light rounded d-flex align-items-center p-4">
                    <i class="bi bi-list-ul text-primary px-2" style="font-size: 3rem; margin-right: 1em;"></i>
                    <div>
                        <p class="mb-2 fs-5 fw-semibold">Total Menu</p>
                        <h6 class="mb-0 fs-6">$1234</h6>
                    </div>
                </div>
            </div>
        </div>
    @endsection --}}
