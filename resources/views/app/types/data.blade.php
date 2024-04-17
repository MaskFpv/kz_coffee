<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tabel Jenis</title>
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
    <h2 class="title">Tabel Jenis</h2>
    <table class="table table-striped">
        <thead>
            <th>No</th>
            <th>Jenis</th>
            <th>Kategori</th>
        </thead>
        <tbody>
            @php
                $counter = 1;
            @endphp
            @foreach ($types as $type)
                <tr>
                    <td>{{ $counter++ }}</td>
                    <td>{{ $type->nama_jenis }}</td>
                    <td>{{ $type->category->nama }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
