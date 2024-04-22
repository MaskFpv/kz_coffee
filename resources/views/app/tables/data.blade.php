<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tabel Meja</title>
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
    <h2 class="title">Tabel Meja</h2>
    <table class="table table-striped">
        <thead>
            <th>Nomor Meja</th>
            <th>Kapasitas</th>
            <th>Status</th>
        </thead>
        <tbody>
            @foreach ($tables as $t)
                <tr>
                    <td>{{ $t->nomor_meja }}</td>
                    <td>{{ $t->kapasitas }}</td>
                    <td>{{ $t->status }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
