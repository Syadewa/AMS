<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">

    <title>
        Berita Acara Serah Terima Aset
    </title>

    <style>

        body{
            font-family: sans-serif;
            font-size: 12px;
            line-height: 1.6;
        }

        .title{
            text-align:center;
            margin-bottom:20px;
        }

        .title h2{
            margin:0;
        }

        .title p{
            margin:0;
        }

        table{
            width:100%;
            border-collapse:collapse;
            margin-top:10px;
        }

        td{
            padding:4px;
            vertical-align:top;
        }

        .section-title{
            margin-top:20px;
            font-weight:bold;
        }

        .signature{
            margin-top:60px;
            width:100%;
        }

        .signature td{
            text-align:center;
            width:50%;
        }

    </style>

</head>

<body>

    <div class="title">

        <h2>
            BERITA ACARA SERAH TERIMA ASET
        </h2>

        <p>
            Nomor:
            BASTA-{{ date('Y') }}-{{ str_pad($assignment->id, 4, '0', STR_PAD_LEFT) }}
        </p>

    </div>

    <p>

        Pada hari ini tanggal
        <strong>
            {{ \Carbon\Carbon::parse($assignment->accepted_at)->format('d F Y') }}
        </strong>,
        telah dilakukan serah terima aset dengan rincian sebagai berikut:

    </p>

    <div class="section-title">
        DATA ASET
    </div>

    <table>

        <tr>

            <td width="180">
                Kode Aset
            </td>

            <td>
                :
            </td>

            <td>
                {{ $assignment->asset->kode_asset }}
            </td>

        </tr>

        <tr>

            <td>
                Nama Aset
            </td>

            <td>
                :
            </td>

            <td>
                {{ $assignment->asset->nama_asset }}
            </td>

        </tr>

        <tr>

            <td>
                Kategori
            </td>

            <td>
                :
            </td>

            <td>
                {{ $assignment->asset->category?->nama_kategori }}
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
                {{ $assignment->asset->serial_number }}
            </td>

        </tr>

    </table>

    <div class="section-title">
        PIHAK YANG MENYERAHKAN
    </div>

    <table>

        <tr>

            <td width="180">
                Nama
            </td>

            <td>
                :
            </td>

            <td>
                {{ $assignment->assignedBy?->name }}
            </td>

        </tr>

    </table>

    <div class="section-title">
        PIHAK YANG MENERIMA
    </div>

    <table>

        <tr>

            <td width="180">
                Nama
            </td>

            <td>
                :
            </td>

            <td>
                {{ $assignment->user?->name }}
            </td>

        </tr>

        <tr>

            <td>
                Department
            </td>

            <td>
                :
            </td>

            <td>
                {{ $assignment->user?->department?->nama_department ?? '-' }}
            </td>

        </tr>

    </table>

    <div class="section-title">
        PERNYATAAN
    </div>

    <p>

        Dengan ditandatanganinya berita acara ini,
        aset tersebut telah diserahkan dan diterima
        dalam kondisi baik serta menjadi tanggung jawab
        pihak penerima sesuai ketentuan perusahaan.

    </p>

    <table class="signature">

        <tr>

            <td>

                Yang Menyerahkan

                <br><br><br><br>

                (____________________)

                <br>

                {{ $assignment->assignedBy?->name }}

            </td>

            <td>

                Yang Menerima

                <br><br><br><br>

                (____________________)

                <br>

                {{ $assignment->user?->name }}

            </td>

        </tr>

    </table>

</body>

</html>