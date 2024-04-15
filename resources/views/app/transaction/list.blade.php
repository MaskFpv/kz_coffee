<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tabel List Transaksi</title>
    <style>
        .table {
            border-collapse: collapse;
            width: 100%;
        }

        .table th,
        .table td {
            border: 1px solid #dddddd;
            padding: 8px;
            text-align: left;
        }

        .table th {
            background-color: rgb(63, 187, 207);
        }

        .title {
            text-align: center;
        }
    </style>
</head>

<body>
    <h2 class="title">Tabel List Transaksi</h2>
    <table class="table table-striped">
        <thead>
            <th>No Faktur</th>
            <th>Tanggal Transaksi</th>
            <th>Pelanggan</th>
            <th>Metode Pembayaran</th>
            <th>Keterangan Pembelian</th>
            <th>Total Pembayaran</th>
        </thead>
        <tbody>
            @foreach ($data as $show)
                <tr>
                    <td>{{ $show->id }}</td>
                    <td>{{ $show->date }}</td>
                    <td>{{ $show->customer->name }}</td>
                    <td>{{ $show->payment_method }}</td>
                    <td>{{ $show->keterangan }}</td>
                    <td>{{ $show->total_price }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
