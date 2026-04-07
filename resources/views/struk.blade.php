@php
$m = $transaksi->durasi_jam;
@endphp

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Struk Parkir</title>
    <style>
        body {
            font-family: monospace;
            font-size: 12px;
            width: 280px;
            margin: auto;
        }

        .center {
            text-align: center;
        }

        .line {
            border-top: 1px dashed #000;
            margin: 6px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        td {
            padding: 2px 0;
            vertical-align: top;
        }

        .right {
            text-align: right;
        }

        .bold {
            font-weight: bold;
        }

        .total {
            font-size: 14px;
            font-weight: bold;
        }

        @media print {
            .no-print {
                display: none;
            }
        }
    </style>
</head>

<body onload="window.print()">

    <div class="center bold">
        STRUK PARKIR
    </div>
    <div class="center">
        Smart Parking System
    </div>

    <div class="line"></div>

    <h3 class='center'>{{ $transaksi->kode_parkir }}</h3>

    <div class="line"></div>

    <table>
        <tr>
            <td>Plat Nomor</td>
            <td class="right">{{ $transaksi->plat_nomor }}</td>
        </tr>
        <tr>
            <td>Kendaraan</td>
            <td class="right">{{ $transaksi->tarif->jenis_kendaraan }}</td>
        </tr>
        <tr>
            <td>Area</td>
            <td class="right">{{ $transaksi->area->nama_area }}</td>
        </tr>
        <tr>
            <td>Tarif</td>
            <td class="right">
                Rp {{ number_format($transaksi->tarif->tarif_per_jam) }}
            </td>
        </tr>
    </table>

    <div class="line"></div>

    <table>
        <tr>
            <td>Masuk</td>
            <td class="right">
                {{ $transaksi->waktu_masuk}}
            </td>
        </tr>
    </table>

    <div class="line"></div>

    <div class="center">
        Terima kasih
    </div>

    <div class="no-print">
        <button onclick="history.back()">Kembali</button>
    </div>

</body>

</html>