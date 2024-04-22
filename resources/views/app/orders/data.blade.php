<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tabel Order</title>
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
    <h2 class="title">Tabel Order</h2>
    <table class="table table-striped">
        <thead>
            <th>No</th>
            <th>Jumlah Pelanggan</th>
            <th>Customer</th>
            <th>Nama Pemesan</th>
            <th>Meja</th>
            <th>Hari Pesan</th>
            <th>Status</th>
        </thead>
        <tbody>
            @php
                $counter = 1;
            @endphp
            @foreach ($orders as $s)
                <tr>
                    <td>{{ $counter++ }}</td>
                    <td>{{ $s->jumlah_pelanggan }}</td>
                    <td>{{ $s->customer->nama }}</td>
                    <td>{{ $s->nama_pemesan }}</td>
                    <td>{{ $s->customer->nama }}</td>
                    <td>{{ $s->hari_pesan }}</td>
                    <td>{{ $s->status }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
