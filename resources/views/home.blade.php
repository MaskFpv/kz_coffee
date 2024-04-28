@extends('layouts.app')

@section('content')
    <div class="container-fluid pt-4 px-4">
        <div class="row row-cols-1 row-cols-sm-2 row-cols-xl-4 g-4">
            <div class="col">
                <div class="bg-light rounded d-flex align-items-center p-4">
                    <i class="bi bi-people text-primary px-2" style="font-size: 3rem; margin-right: 1em;"></i>
                    <div>
                        <p class="mb-2 fs-5 fw-semibold">Jumlah Pelanggan</p>
                        <h6 class="mb-0 fs-6">$1234</h6>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="bg-light rounded d-flex align-items-center p-4">
                    <i class="bi bi-journals text-primary px-2" style="font-size: 3rem; margin-right: 1em;"></i>
                    <div>
                        <p class="mb-2 fs-5 fw-semibold">Jumlah Menu</p>
                        <h6 class="mb-0 fs-6">$1234</h6>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="bg-light rounded d-flex align-items-center p-4">
                    <i class="bi bi-list-ul text-primary px-2" style="font-size: 3rem; margin-right: 1em;"></i>
                    <div>
                        <p class="mb-2 fs-5 fw-semibold">Total Transaksi</p>
                        <h6 class="mb-0 fs-6">$1234</h6>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="bg-light rounded d-flex align-items-center p-4">
                    <i class="bi bi-bar-chart text-primary px-2" style="font-size: 3rem; margin-right: 1em;"></i>
                    <div>
                        <p class="mb-2 fs-5 fw-semibold">Total Revenue</p>
                        <h6 class="mb-0 fs-6">$1234</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
