<!DOCTYPE html>
<html lang="en">

<style>
    table {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }

    td,
    th {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 8px;
    }

    tr:nth-child(even) {
        background-color: #dddddd;
    }
</style>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <a href="{{ url('/profesi') }}">
        <h3>Jumlah Profesi</h3>
    </a>
    <table>
        <tr>
            <th>Nomor</th>
            <th>Nama</th>
            <th>Jenis Kelamin</th>
            <th>Nama Jalan</th>
            <th>Email</th>
            <th>Profesi</th>
        </tr>
        @foreach ($db as $i => $item)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td>{{ $item->nama }}</td>
                <td>{{ $item->jenis_kelamin }}</td>
                <td>{{ $item->nama_jalan }}</td>
                <td>{{ $item->email }}</td>
                <td>{{ $item->nama_profesi }}</td>
            </tr>
        @endforeach
    </table>
</body>

</html>
