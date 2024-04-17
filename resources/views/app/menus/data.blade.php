<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tabel Menu</title>
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
    <h2 class="title">Tabel Menu</h2>
    <table class="table table-striped">
        <thead>
            <th>No</th>
            <th>Nama</th>
            <th>Jenis Menu</th>
            <th>Harga</th>
            <th>Photo</th>
        </thead>
        <tbody>
            @php
                $counter = 1;
            @endphp
            @foreach ($menus as $menu)
                <tr>
                    <td>{{ $counter++ }}</td>
                    <td>{{ $menu->nama }}</td>
                    <td>{{ $menu->type->nama_jenis }}</td>
                    <td>Rp. {{ isset($menu->harga) ? number_format($menu->harga, 0, ',', '.') : '-' }}</td>
                    <td><img src="{{ public_path('storage/images/' . $menu->photo ? \Storage::url($menu->photo) : '') }}"
                            alt="" style="width: 100px; height: 100px; background-size: cover"></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
