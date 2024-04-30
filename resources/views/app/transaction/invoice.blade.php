<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <title>{{ $data->id }}</title>
    <style>
        body {
            margin-top: 20px;
            background-color: #eee;
        }

        .card {
            box-shadow: 0 20px 27px 0 rgb(0 0 0 / 5%);
        }

        .card {
            position: relative;
            display: flex;
            flex-direction: column;
            min-width: 0;
            word-wrap: break-word;
            background-color: #fff;
            background-clip: border-box;
            border: 0 solid rgba(0, 0, 0, .125);
            border-radius: 1rem;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="card ">
                    <div class="card-body p-5">
                        <div class="invoice-title">
                            <h4 class="float-end font-size-15">Nota : {{ $data->id }} </h4>
                            <div class="mb-4">
                                <h2 class="mb-1 text-muted">KZCoffee</h2>
                            </div>
                            <div class="text-muted">
                                <p class="mb-1"> PIK Jakarta Selatan</p>
                                <p class="mb-1">{{ Auth()->user()->name }}</p>
                                <p class="mb-1">{{ Auth()->user()->email }}</p>
                            </div>
                        </div>

                        <hr class="my-4">

                        <div class="row">
                            <div class="col-6 mt-2">
                                <div class="text-muted">
                                    <h5 class="font-size-15">
                                        Nama :
                                        {{ $data->customer->nama == 'Customer' ? 'Pelanggan Umum' : $data->customer->nama }}
                                    </h5>
                                    @if ($data->customer->nama != 'Customer')
                                        <p class="mb-1">Alamat : {{ $data->customer->alamat }}</p>
                                        <p class="mb-1">Email : {{ $data->customer->email }}</p>
                                    @endif
                                </div>
                            </div>
                            <!-- end col -->
                            <div class="col-6 mt-2">
                                <div class="text-muted text-sm-end">
                                    <div class="font-size-14">
                                        <h5 class="font-size-15 mb-1">Tanggal Pembelian:</h5>
                                        <p>{{ \Carbon\Carbon::parse($data->date)->format('d M Y') }}</p>
                                    </div>
                                </div>
                            </div>
                            <!-- end col -->
                        </div>
                        <!-- end row -->

                        <div class="py-2 mt-5">
                            <h5 class="fs-4">Order :</h5>

                            <div class="table-responsive">
                                <table class="table align-middle table-nowrap table-centered mb-0">
                                    <thead>
                                        <tr>
                                            <th style="width: 70px;">No.</th>
                                            <th>Menu</th>
                                            <th>Harga</th>
                                            <th>Jumlah</th>
                                            <th class="text-end" style="width: 120px;">Total</th>
                                        </tr>
                                    </thead><!-- end thead -->
                                    <tbody>
                                        @foreach ($data->transactionDetails as $item)
                                            <tr>
                                                <th scope="row">0{{ $loop->index + 1 }}</th>
                                                <td>{{ $item->menu->nama }}</td>
                                                <td>Rp. {{ $item->unit_price }}</td>
                                                <td>{{ $item->qty }}</td>
                                                <td class="text-end">Rp. {{ $item->sub_total }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="total d-flex gap-4 m-3 justify-content-end">
                                <h4 class="border-0 text-end">Total: </h4>
                                <h4 class="m-0 fw-semibold text-end" colspan="3">Rp
                                    {{ $data->total_price }}
                                </h4>
                            </div>
                            <div class="d-print-none mt-4">
                                <div class="float-end">
                                    <a href="javascript:window.print()" class="btn btn-success me-1"><i
                                            class="fa fa-print">Print</i></a>
                                    <a href="{{ route('transaction.index') }}" class="btn btn-light w-md">Back</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
