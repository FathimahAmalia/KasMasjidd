<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Rekap Kas Masjid</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin: 0;
            padding: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
            border-bottom: 2px solid #000;
            padding-bottom: 10px;
        }
        .header h2, .header h3, .header p {
            margin: 0;
        }
        .header h2 { font-size: 18px; margin-bottom: 5px; }
        .header p { margin-top: 5px; }
        
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid #000;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
            text-align: center;
        }
        .text-center { text-align: center; }
        .text-end { text-align: right; }
        
        .totals {
            width: 40%;
            float: right;
            margin-top: 10px;
        }
        .totals table {
            border: none;
        }
        .totals td {
            border: none;
            padding: 5px;
        }
        
        .clear { clear: both; }

        .signature {
            margin-top: 50px;
            width: 100%;
            display: flex;
            justify-content: space-between;
        }
        .signature-box {
            width: 30%;
            text-align: center;
        }
        .signature-box p {
            margin-bottom: 60px;
        }
        
        @media print {
            .no-print { display: none; }
            @page { margin: 1cm; }
        }
    </style>
</head>
<body onload="window.print()">

    <div class="header">
        <h2>KAS MASJID</h2>
        <h3>LAPORAN REKAP KAS MASJID</h3>
        @if(isset($startDate) && isset($endDate))
            <p>Periode: {{ \Carbon\Carbon::parse($startDate)->translatedFormat('d F Y') }} - {{ \Carbon\Carbon::parse($endDate)->translatedFormat('d F Y') }}</p>
        @elseif(isset($startDate))
            <p>Periode: Sejak {{ \Carbon\Carbon::parse($startDate)->translatedFormat('d F Y') }}</p>
        @elseif(isset($endDate))
            <p>Periode: Sampai {{ \Carbon\Carbon::parse($endDate)->translatedFormat('d F Y') }}</p>
        @else
            <p>Periode: Semua Data</p>
        @endif
    </div>

    <table>
        <thead>
            <tr>
                <th width="5%">No</th>
                <th width="15%">Tanggal</th>
                <th>Keterangan</th>
                <th width="15%">Pemasukan</th>
                <th width="15%">Pengeluaran</th>
                <th width="15%">Saldo</th>
            </tr>
        </thead>
        <tbody>
            @forelse($rekapsCetak as $rekap)
            <tr>
                <td class="text-center">{{ $loop->iteration }}</td>
                <td class="text-center">{{ \Carbon\Carbon::parse($rekap->tanggal)->format('d-m-Y') }}</td>
                <td>
                    {{ $rekap->keterangan ?? ($rekap->jenis == 'pemasukan' ? $rekap->sumber_dana : $rekap->jenis_pengeluaran) }}
                </td>
                <td class="text-end">
                    @if($rekap->jenis == 'pemasukan')
                        Rp {{ number_format($rekap->jumlah, 0, ',', '.') }}
                    @else
                        -
                    @endif
                </td>
                <td class="text-end">
                    @if($rekap->jenis == 'pengeluaran')
                        Rp {{ number_format($rekap->jumlah, 0, ',', '.') }}
                    @else
                        -
                    @endif
                </td>
                <td class="text-end">
                    Rp {{ number_format($rekap->saldo_akhir, 0, ',', '.') }}
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center">Tidak ada data transaksi.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="totals">
        <table>
            <tr>
                <td><strong>Total Pemasukan</strong></td>
                <td>:</td>
                <td class="text-end">Rp {{ number_format($totalPemasukan, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td><strong>Total Pengeluaran</strong></td>
                <td>:</td>
                <td class="text-end">Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td><strong>Saldo Akhir</strong></td>
                <td>:</td>
                <td class="text-end"><strong>Rp {{ number_format($saldo, 0, ',', '.') }}</strong></td>
            </tr>
        </table>
    </div>

    <div class="clear"></div>

    <div class="signature">
        <div class="signature-box">
            <p>Mengetahui,<br>Ketua </p>
            <br>
            <strong>(............................)</strong>
        </div>
        <div class="signature-box">
            <p>{{ now()->translatedFormat('d F Y') }}<br>Bendahara</p>
            <br>
            <strong>(............................)</strong>
        </div>
    </div>

</body>
</html>
