<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Surat Perintah Pengiriman Barang</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
        }

        .header {
            width: 100%;
            margin-bottom: 10px;
        }

        .header td {
            border: none;
            vertical-align: top;
        }

        .logo {
            height: 40px;
        }

        .queue-number {
            text-align: right;
            font-size: 14px;
            font-weight: bold;
        }

        .section-title {
            text-align: center;
            font-weight: bold;
            font-size: 16px;
            margin: 10px 0;
        }

        table.product {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
        }

        td,
        th {
            border: 1px solid black;
            padding: 5px;
            text-align: left;
        }

        .no-border td {
            border: none;
        }

        .signature {
            width: 100%;
            margin-top: 40px;
        }

        .signature td {
            border: none;
            text-align: center;
            height: 80px;
        }
    </style>
</head>

<body>

    <table class="header">
        <tr>
            <td>
                <strong>PT. MACCON GENERASI MANDIRI<br>BATA RINGAN & PANEL, LANTAI AAC</strong>
            </td>
            <td class="queue-number">
                No. Antrean: <span>{{ $pendaftaran->toAntrean->no_antrean }}</span>
            </td>
        </tr>
    </table>

    <div class="section-title">SURAT PERINTAH PENGIRIMAN BARANG</div>

    <table class="no-border">
        <tr>
            <td><strong>NO. SO / AR</strong></td>
            <td>{{ $pendaftaran->no_so }}</td>
            <td><strong>PELANGGAN</strong></td>
            <td></td>
        </tr>
        <tr>
            <td><strong>TANGGAL SPBB</strong></td>
            <td>{{ tgl_indo($pendaftaran->created_at) }}</td>
            <td><strong>SUB DIS / DISTRIBUTOR</strong></td>
            <td>{{ $pendaftaran->distributor }}</td>
        </tr>
        <tr>
            <td><strong>NO. URUT</strong></td>
            <td>{{ $pendaftaran->toAntrean->no_antrean }}</td>
            <td><strong>UP. DRIVER</strong></td>
            <td>{{ $pendaftaran->nama }} - ({{ $pendaftaran->toKendaraan->no_pol }})</td>
        </tr>
        <tr>
            <td><strong>SALES</strong></td>
            <td>{{ $pendaftaran->toUser->name }}</td>
            <td><strong>ALAMAT</strong></td>
            <td>{{ $pendaftaran->tujuan }}</td>
        </tr>
    </table>

    <table class="product">
        <thead>
            <tr>
                <th>TIPE</th>
                <th>PRODUK</th>
                <th>QTY</th>
                <th>SATUAN</th>
                <th>PALET</th>
                <th>REMARK</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pendaftaran->toPendaftaranProduk as $item)
            <tr>
                <td>{{ $item->toProduk->tipe }}</td>
                <td>{{ $item->toProduk->nama }}</td>
                <td>{{ $item->qty }}</td>
                <td>{{ $item->toProduk->toSatuan->nama }}</td>
                <td>{{ $item->palet ?? '-' }}</td>
                <td>{{ $item->remark ?? '-' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <table class="signature">
        <tr>
            <td>Dibuat Oleh,<br><br><br><br>(Delivery SPBB)</td>
            <td>Disetujui Oleh,<br><br><br><br>(Logistik)</td>
        </tr>
    </table>

</body>

</html>