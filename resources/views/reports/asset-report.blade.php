<!DOCTYPE html>

<html>

<head>

```
<meta charset="utf-8">

<title>
    Laporan Data Aset
</title>

<style>

    body{
        font-family: sans-serif;
        font-size:12px;
    }

    .header{
        text-align:center;
        margin-bottom:20px;
    }

    .header h1{
        margin:0;
        font-size:20px;
    }

    .header h2{
        margin:5px 0;
        font-size:16px;
        font-weight:normal;
    }

    .info{
        margin-bottom:15px;
    }

    .summary{
        margin-bottom:20px;
    }

    table{
        width:100%;
        border-collapse:collapse;
    }

    th, td{
        border:1px solid #000;
        padding:6px;
        font-size:11px;
    }

    th{
        background:#f0f0f0;
    }

    .footer{
        margin-top:40px;
        text-align:right;
    }

</style>
```

</head>

<body>

```
<div class="header">

    <h1>
        ASSET MANAGEMENT SYSTEM
    </h1>

    <h2>
        LAPORAN DATA ASET
    </h2>

</div>

<div class="info">

    <strong>Tanggal Cetak :</strong>
    {{ now()->format('d-m-Y H:i') }}

</div>

<div class="summary">

    <strong>Total Asset :</strong>
    {{ $assets->count() }}

</div>

<table>

    <thead>

        <tr>

            <th>No</th>

            <th>Kode Asset</th>

            <th>Nama Asset</th>

            <th>Kategori</th>

            <th>Department</th>

            <th>Status</th>

        </tr>

    </thead>

    <tbody>

        @foreach($assets as $asset)

            <tr>

                <td>{{ $loop->iteration }}</td>

                <td>{{ $asset->kode_asset }}</td>

                <td>{{ $asset->nama_asset }}</td>

                <td>{{ $asset->category?->nama_kategori }}</td>

                <td>{{ $asset->department?->nama_department }}</td>

                <td>{{ ucfirst($asset->status_asset) }}</td>

            </tr>

        @endforeach

    </tbody>

</table>

<div class="footer">

    Dicetak oleh Sistem AMS<br>

    {{ now()->format('d-m-Y H:i') }}

</div>
```

</body>

</html>
