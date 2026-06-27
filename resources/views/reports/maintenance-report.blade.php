<!DOCTYPE html>

<html>

<head>

```
<meta charset="utf-8">

<title>
    Laporan Maintenance Aset
</title>

<style>

    body{
        font-family:sans-serif;
        font-size:12px;
    }

    .header{
        text-align:center;
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
        margin-top:30px;
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
        LAPORAN MAINTENANCE ASET
    </h2>

</div>

<p>

    Tanggal Cetak :
    {{ now()->format('d-m-Y H:i') }}

</p>

<p>

    Total Maintenance :
    {{ $maintenances->count() }}

</p>

<table>

    <thead>

        <tr>

            <th>No</th>

            <th>Asset</th>

            <th>Requested By</th>

            <th>Status</th>

            <th>Handled By</th>

            <th>Tanggal</th>

        </tr>

    </thead>

    <tbody>

        @foreach($maintenances as $maintenance)

            <tr>

                <td>
                    {{ $loop->iteration }}
                </td>

                <td>
                    {{ $maintenance->asset?->nama_asset }}
                </td>

                <td>
                    {{ $maintenance->requestedBy?->name }}
                </td>

                <td>
                    {{ ucfirst($maintenance->status_maintenance) }}
                </td>

                <td>
                    {{ $maintenance->handledBy?->name ?? '-' }}
                </td>

                <td>
                    {{ $maintenance->tanggal_pengajuan }}
                </td>

            </tr>

        @endforeach

    </tbody>

</table>

<div class="footer">

    Dicetak oleh Sistem AMS

</div>
```

</body>

</html>
