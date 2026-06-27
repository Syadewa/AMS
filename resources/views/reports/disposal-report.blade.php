<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">

    <title>
        Laporan Disposal Aset
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

</head>

<body>

    <div class="header">

        <h1>
            ASSET MANAGEMENT SYSTEM
        </h1>

        <h2>
            LAPORAN DISPOSAL ASET
        </h2>

    </div>

    <p>

        Tanggal Cetak :
        {{ now()->format('d-m-Y H:i') }}

    </p>

    <p>

        Total Disposal :
        {{ $disposals->count() }}

    </p>

    <table>

        <thead>

            <tr>

                <th>No</th>

                <th>Asset</th>

                <th>Jenis Pelepasan</th>

                <th>Status</th>

                <th>Requested By</th>

                <th>Approved By</th>

                <th>Tanggal Pengajuan</th>

            </tr>

        </thead>

        <tbody>

            @foreach($disposals as $disposal)

                <tr>

                    <td>
                        {{ $loop->iteration }}
                    </td>

                    <td>
                        {{ $disposal->asset?->nama_asset }}
                    </td>

                    <td>
                        {{ ucfirst($disposal->jenis_pelepasan) }}
                    </td>

                    <td>
                        {{ ucfirst($disposal->status_approval) }}
                    </td>

                    <td>
                        {{ $disposal->requestedBy?->name }}
                    </td>

                    <td>
                        {{ $disposal->approvedBy?->name ?? '-' }}
                    </td>

                    <td>
                        {{ $disposal->tanggal_pengajuan }}
                    </td>

                </tr>

            @endforeach

        </tbody>

    </table>

    <div class="footer">

        Dicetak oleh Sistem AMS

    </div>

</body>

</html>