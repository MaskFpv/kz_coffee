@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">

            <div class="card-body">
                <div class="searchbar mt-4 mb-4">
                    <div class="row">
                        <div class="col-md-6 text-left">
                            <h4 class="card-title">@lang('crud.transaction.index_title')</h4>
                        </div>
                        <div class="col-md-6 text-right">
                            <button type="button" id="export-pdf-btn" class="btn btn-danger">
                                <a href="{{ route('transaction-list-exportPdf') }}"
                                    style="text-decoration: none; color:azure;"><i class="bi bi-file-earmark-pdf"></i>
                                    Export PDF</a>
                            </button>
                            <button type="button" id="export-pdf-btn" class="btn btn-success">
                                <a href="{{ route('list-export') }}" style="text-decoration: none; color:azure;"><i
                                        class="bi bi-file-earmark-excel"></i>
                                    Export XLS</a>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-borderless table-hover" id="myTable">
                        <thead>
                            <tr>
                                <th class="text-left">
                                    @lang('crud.transaction.inputs.id')
                                </th>
                                <th class="text-left">
                                    @lang('crud.transaction.inputs.date')
                                </th>
                                <th class="text-left">
                                    @lang('crud.transaction.inputs.customer')
                                </th>
                                <th class="text-left">
                                    @lang('crud.transaction.inputs.payment_method')
                                </th>
                                <th class="text-left">
                                    @lang('crud.transaction.inputs.keterangan')
                                </th>
                                <th class="text-right">
                                    @lang('crud.transaction.inputs.total_price')
                                </th>
                                <th class="text-center">
                                    @lang('crud.common.actions')
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($transactions as $transaction)
                                <tr>
                                    <td>{{ $transaction->id ?? '-' }}</td>
                                    <td>{{ $transaction->date ?? '-' }}</td>
                                    <td>{{ $transaction->customer->name ?? '-' }}</td>
                                    <td>{{ $transaction->payment_method ?? '-' }}</td>
                                    <td>{{ $transaction->keterangan ?? '-' }}</td>
                                    <td>Rp {{ number_format($transaction->total_price, 0, ',', '.') ?? '-' }}</td>
                                    <td class="text-center" style="width: 134px;">
                                        <div role="group" aria-label="Row Actions" class="btn-group d-flex gap-2">
                                            @can('view', $transaction)
                                                <a href="/transaction/show/{{ $transaction->id }}">
                                                    <button type="button" class="btn btn-light">
                                                        <i class="icon ion-md-eye"></i>
                                                    </button>
                                                </a>
                                                <a class="buka-invoice" data-no_invoice="{{ $transaction->id ?? '' }}">
                                                    <button type="button" class="btn btn-light">
                                                        <i class="bi bi-receipt"></i>
                                                    </button>
                                                </a>
                                            @endcan
                                        </div>
                                    </td>
                                </tr>
                            @empty
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <script>
                    $(document).ready(function() {
                        $('#myTable').DataTable({
                            "order": [
                                [1, "desc"]
                            ]
                        });
                    });
                </script>
            </div>
        </div>
    </div>
@endsection
