<div>
    <h2 class="px-4">Dashboard</h2>
    <hr>
    <div class="container-fluid p-4">
        {{-- Barisan pertama --}}
        <div class="row">
            {{-- Tampilan --}}
            <div class="col-xl-3 mt-2 mt-2">
                <div class="bg-light rounded d-flex align-items-center p-4">
                    <i class="bi bi-graph-up text-primary px-2" style="font-size: 3rem; margin-right: 1em;"></i>
                    <div>
                        <p class="mb-2 fs-6">Jumlah Transaksi</p>
                        <h6 class="mb-0 fs-4 fw-bold">{{ $totalTransaksi }} Transaksi</h6>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 mt-2 mt-2">
                <div class="bg-light rounded d-flex align-items-center p-4">
                    <i class="bi bi-cash-stack text-primary px-2" style="font-size: 3rem; margin-right: 1em;"></i>
                    <div>
                        <p class="mb-2 fs-6">Omset Pendapatan</p>
                        <h6 class="mb-0 fs-4 fw-bold">Rp {{ number_format($totalOmset, 0, ',', '.') }} ;-</h6>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 mt-2 mt-2">
                <div class="bg-light rounded d-flex align-items-center p-4">
                    <i class="bi bi-people text-primary px-2" style="font-size: 3rem; margin-right: 1em;"></i>
                    <div>
                        <p class="mb-2 fs-6 ">Total Customer</p>
                        <h6 class="mb-0 fs-4 fw-bold">{{ $totalCustomer }}</h6>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 mt-2 mt-2">
                <div class="bg-light rounded d-flex align-items-center p-4">
                    <i class="bi bi-journal-text text-primary px-2" style="font-size: 3rem; margin-right: 1em;"></i>
                    <div>
                        <p class="mb-2 fs-6 ">Total Menu</p>
                        <h6 class="mb-0 fs-4 fw-bold">{{ $totalMenu }}</h6>
                    </div>
                </div>
            </div>
        </div>
        {{-- Barisan Kedua --}}
        <div class="row mt-4">
            {{-- For Graphics --}}
            <div class="col-xl-8 mt-2">
                <div class="bg-light rounded p-4" style="height: 40rem">
                    <div class="header">
                        <div class="header-1 px-3 py-1">
                            <p class="mb-2 fs-4 fw-bold">Grafik Pendapatan</p>
                        </div>
                    </div>
                    <div class="grafik mt-1">
                        <canvas id="myChart" style="width: 100%; height: 500px;"></canvas>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 mt-2">
                <div class="bg-light rounded p-4" style="height: 40rem;">
                    <div class="header">
                        <div class="d-flex justify-content-between">
                            <div class="header-1 px-3 py-1">
                                <p class="mb-2 fs-4 fw-bold">Top 5 Penjualan</p>
                            </div>
                            <div class="header-2">
                                <a href="{{ route('transaction.index') }}">
                                    <p class="fs-6 text-info fw-light px-3 py-2">Lihat Detail</p>
                                </a>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="detail-menu mt-3 scrollable" style="height: calc(100% - 100px); overflow-y: auto;">
                        @if ($topMenus)
                            @foreach ($topMenus as $menu)
                                <div class="card mb-3" style="border-radius: 8px; width: 97%">
                                    <div class="produk d-flex align-items-center p-2">
                                        <img src="{{ $menu->photo ? \Storage::url($menu->photo) : '' }}"
                                            alt="{{ $menu->nama }}" class="m-2 img-thumbnail"
                                            style="width:70px; height: 70px; object-fit: cover">
                                        <div class="w-100 d-flex justify-content-between align-items-center">
                                            <div class="info p-2 ml-4">
                                                <p class="mb-2 fs-5 fw-bolder">{{ $menu->nama }}</p>
                                                <p class="mb-2 fs-6 text-muted">{{ $menu->total_qty }}
                                                    Terjual</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <p>
                                <center>Data Tidak Tersedis</center>
                            </p>
                        @endif
                    </div>
                </div>
            </div>

        </div>
        {{-- Barisan Ketiga --}}
        <div class="row mt-4">
            <div class="col-xl-6 mt-2">
                <div class="bg-light rounded p-4" style="height: 36rem">
                    <div class="header mb-3">
                        <div class="d-flex justify-content-between">
                            <div class="header-1 px-3 py-1">
                                <p class="mb-2 fs-4 fw-bold">Transaksi Terbaru</p>
                            </div>
                            <div class="header-2">
                                <a href="{{ route('transaction.data') }}">
                                    <p class="fs-6 text-info fw-light px-3 py-2">Lihat Detail</p>
                                </a>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="detail-menu mt-3 scrollable" style="height: calc(100% - 100px); overflow-y: auto;">
                        @if ($recentTransactions->isNotEmpty())
                            @foreach ($recentTransactions as $transaction)
                                <div class="card mb-3" style="border-radius: 8px; width: 97%">
                                    <div class="produk d-flex align-items-center p-2">
                                        <i class="bi bi-cart-check text-primary px-2"
                                            style="font-size: 3rem; margin-left: 10px;"></i>
                                        <div class="w-100 d-flex justify-content-between align-items-center">
                                            <div class="info p-2 ml-4">
                                                <p class="mb-2 fs-6 fw-bolder">Transaksi ID: {{ $transaction->id }}
                                                </p>
                                                <p class="mb-2 fs-6 text-muted">Waktu: {{ $transaction->created_at }}
                                                </p>
                                                <p class="mb-2 fs-6">Rp.
                                                    {{ number_format($transaction->total_harga, 0, ',', '.') }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <p>
                                <center>Data Tidak Tersedia</center>
                            </p>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-xl-6 mt-2">
                <div class="bg-light rounded p-4" style="height: 36rem">
                    <div class="header mb-3">
                        <div class="d-flex justify-content-between">
                            <div class="header-1 px-3 py-1">
                                <p class="mb-2 fs-4 fw-bold">Stok Terendah</p>
                            </div>
                            <div class="header-2">
                                <a href="{{ route('stocks.index') }}">
                                    <p class="fs-6 text-info fw-light px-3 py-2">Lihat Detail</p>
                                </a>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="detail-menu mt-3 scrollable" style="height: calc(100% - 100px); overflow-y: auto;">
                        @if ($lowStockMenus)
                            @foreach ($lowStockMenus as $m)
                                <div class="card mb-3" style="border-radius: 8px; width: 97%">
                                    <div class="produk d-flex align-items-center p-2">
                                        <img src="{{ $m->photo ? \Storage::url($m->photo) : '' }}"
                                            alt="{{ $m->nama }}" class="m-2 img-thumbnail"
                                            style="width:70px; height: 70px; object-fit: cover">
                                        <div class="w-100 d-flex justify-content-between align-items-center">
                                            <div class="info p-2 ml-4">
                                                <p class="mb-2 fs-5 fw-bolder">{{ $m->nama }}</p>
                                                <p class="mb-2 fs-6 text-muted">{{ $m->total_stock }} Stok Tersisa</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <p>
                                <center>Data Tidak Tersedia</center>
                            </p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <!-- Script Chart.js dari CDN -->
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            document.addEventListener('livewire:load', function() {
                var ctx = document.getElementById('myChart').getContext('2d');
                var myChart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: @json($dates), // Gunakan data tanggal dari Livewire
                        datasets: [{
                            label: 'Omset per Hari',
                            data: @json($omsets), // Gunakan data omset per hari dari Livewire
                            backgroundColor: 'rgba(99, 255, 203, 0.2)',
                            borderColor: 'rgb(23, 56, 106)',
                            borderWidth: 3
                        }]
                    },
                    options: {
                        responsive: true, // Set responsivitas ke true
                        maintainAspectRatio: false, // Biarkan aspek rasio tidak dipertahankan
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                        }
                    }
                });
            });
        </script>

    </div>
