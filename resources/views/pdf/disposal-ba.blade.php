<!DOCTYPE html>

<html>

<head>

```
<meta charset="utf-8">

<title>
    Berita Acara Pelepasan Aset
</title>

<style>

    body {
        font-family: sans-serif;
        font-size: 12px;
    }

    h1 {
        text-align: center;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    td {
        padding: 4px;
        vertical-align: top;
    }

    .signature {
        margin-top: 80px;
    }

</style>
```

</head>

<body>

```
<h1>
    BERITA ACARA PELEPASAN ASET
</h1>

<hr>

<p>

    Nomor :

    BA-DSL-{{ date('Y') }}-{{ str_pad($disposal->id, 4, '0', STR_PAD_LEFT) }}

</p>

<h3>
    Data Asset
</h3>

<table>

    <tr>

        <td width="180">
            Kode Asset
        </td>

        <td>
            :
        </td>

        <td>
            {{ $disposal->asset->kode_asset }}
        </td>

    </tr>

    <tr>

        <td>
            Nama Asset
        </td>

        <td>
            :
        </td>

        <td>
            {{ $disposal->asset->nama_asset }}
        </td>

    </tr>

    <tr>

        <td>
            Serial Number
        </td>

        <td>
            :
        </td>

        <td>
            {{ $disposal->asset->serial_number }}
        </td>

    </tr>

    <tr>

        <td>
            Jenis Pelepasan
        </td>

        <td>
            :
        </td>

        <td>
            {{ ucfirst($disposal->jenis_pelepasan) }}
        </td>

    </tr>

</table>

<h3>
    Alasan Pelepasan
</h3>

<p>

    {{ $disposal->alasan }}

</p>

<h3>
    Persetujuan
</h3>

<table>

    <tr>

        <td width="180">
            Diajukan Oleh
        </td>

        <td>
            :
        </td>

        <td>
            {{ $disposal->requestedBy->name }}
        </td>

    </tr>

    <tr>

        <td>
            Disetujui Oleh
        </td>

        <td>
            :
        </td>

        <td>
            {{ $disposal->approvedBy->name }}
        </td>

    </tr>

    <tr>

        <td>
            Tanggal Persetujuan
        </td>

        <td>
            :
        </td>

        <td>
            {{ $disposal->approved_at }}
        </td>

    </tr>

</table>

<div class="signature">

    <table>

        <tr>

            <td align="center">

                Diajukan Oleh

            </td>

            <td align="center">

                Disetujui Oleh

            </td>

        </tr>

        <tr>

            <td align="center">

                <br><br><br>

                ( {{ $disposal->requestedBy->name }} )

            </td>

            <td align="center">

                <br><br><br>

                ( {{ $disposal->approvedBy->name }} )

            </td>

        </tr>

    </table>

</div>
```

</body>

</html>
