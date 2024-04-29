<div>
    <div class="container-fluid pt-1 px-5">
        <h3>Laporan Transaksi</h3>
        <div>
            <form wire:submit='getLaporan'>
                <div class="input-tanggal row mt-4 px-5">
                    <div class="col-md-5">
                        <label class="p-2" for="awal">Tanggal Mulai</label>
                        <div class="input-group w-100 align-items-center @error('start_date') is-invalid @enderror">
                            <input type="date" class="form-control @error('start_date') is-invalid @enderror"
                                name="start_date" wire:model.lazy='start_date'>
                            @error('start_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-5">
                        <label class="p-2" for="akhir">Tanggal Akhir</label>
                        <div class="input-group align-items-center @error('end_date') is-invalid @enderror">
                            <input class="form-control @error('end_date') is-invalid @enderror" type="date"
                                name="end_date" wire:model.lazy='end_date'>
                            @error('end_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-2 my-5">
                        <button class="btn btn-primary btn-block my-auto" type="submit"
                            style="width: 150px">Search</button>
                    </div>
                </div>
            </form>


            <div class="card p-4">
                <div class="d-flex justify-content-end mb-3">
                    <a href="/laporan/exportpdf/{{ $start_date }}/{{ $end_date }}" class="btn btn-danger">
                        <i class="bi bi-file-pdf"></i> Export PDF
                    </a>
                </div>
                <div class="table-responsive mt-1">
                    <table id="myTable" class="table table-bordered table-hover mt-2">
                        <thead>
                            <tr>
                                <th class="text-left">@lang('crud.transaction.inputs.id')</th>
                                <th class="text-left">@lang('crud.transaction.inputs.date')</th>
                                <th class="text-left">@lang('crud.transaction.inputs.customer')</th>
                                <th class="text-left">@lang('crud.transaction.inputs.payment_method')</th>
                                <th class="text-left">@lang('crud.transaction.inputs.keterangan')</th>
                                <th class="text-right">@lang('crud.transaction.inputs.total_price')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($data_laporan as $transaction)
                                <tr>
                                    <td>{{ $transaction->id ?? '-' }}</td>
                                    <td>{{ date('Y-m-d', strtotime($transaction->date)) ?? '-' }}</td>
                                    <td>{{ $transaction->customer->name ?? '-' }}</td>
                                    <td>{{ $transaction->payment_method ?? '-' }}</td>
                                    <td>{{ $transaction->keterangan ?? '-' }}</td>
                                    <td>Rp {{ number_format($transaction->total_price, 0, ',', '.') ?? '-' }}</td>
                                </tr>
                            @empty
                            @endforelse
                        </tbody>

                        <tfoot>
                            <tr>
                                <th colspan="5" class="text-right">Total Pendapatan</th>
                                <th>Rp {{ number_format($total_pendapatan, 0, ',', '.') }}</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>
