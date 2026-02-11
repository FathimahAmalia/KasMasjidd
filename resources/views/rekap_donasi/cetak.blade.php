<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Donasi Online</title>
    <style>
        body { font-family: sans-serif; font-size: 14px; }
        .header { text-align: center; margin-bottom: 30px; }
        .header h2 { margin: 0; padding: 0; }
        .header p { margin: 5px 0; color: #555; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        table, th, td { border: 1px solid #333; }
        th, td { padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .text-right { text-align: right; }
        .text-center { text-align: center; }
        .total-row { font-weight: bold; background-color: #e6e6e6; }
        .timestamp { position: fixed; bottom: 20px; left: 0; font-size: 10px; color: #888; }
    </style>
</head>
<body onload="window.print()">

    <div class="header">
        <h2>Laporan Rekap Donasi Online</h2>
        <h3>Masjid Nabawi</h3>
        <p>Periode: {{ $periode }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th class="text-center" width="5%">No</th>
                <th width="15%">Tanggal</th>
                <th width="20%">Donatur</th>
                <th width="15%">Tipe Donasi</th>
                <th width="25%">Keterangan/Pesan</th>
                <th class="text-right" width="20%">Nominal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($donasis as $donasi)
            <tr>
                <td class="text-center">{{ $loop->iteration }}</td>
                <td>{{ \Carbon\Carbon::parse($donasi->tanggal_donasi)->format('d/m/Y H:i') }}</td>
                <td>
                    <b>{{ $donasi->nama }}</b><br>
                    <small>{{ $donasi->email }}</small>
                </td>
                <td>{{ $donasi->jenis_donasi == 'masjid' ? 'Kas Masjid' : 'Kas Sosial' }}</td>
                <td>{{ $donasi->pesan ?? '-' }}</td>
                <td class="text-right">Rp {{ number_format($donasi->jumlah, 0, ',', '.') }}</td>
            </tr>
            @endforeach
            <tr class="total-row">
                <td colspan="5" class="text-center">Total Penerimaan Donasi Verified (Success)</td>
                <td class="text-right">Rp {{ number_format($totalDonasi, 0, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>

    <div class="timestamp">
        Dicetak pada: {{ now()->format('d/m/Y H:i:s') }} oleh Administrator
    </div>

</body>
</html>
