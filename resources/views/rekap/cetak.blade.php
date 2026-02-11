<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekap Kas Masjid</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        @media print {
            .no-print { display: none; }
        }

        table th, table td {
            vertical-align: middle;
        }

        body {
            font-family: Arial, sans-serif;
            font-size: 14px;
        }

        h4 {
            margin-bottom: 20px;
        }
    </style>
</head>
<body onload="window.print()">

<div class="container mt-4">

    <div class="text-center mb-4">
        <h4>Rekap Kas Masjid</h4>
        @if(isset($tglAwal) && isset($tglAkhir))
            <p>Periode: {{ \Carbon\Carbon::parse($tglAwal)->format('d-m-Y') }} s/d {{ \Carbon\Carbon::parse($tglAkhir)->format('d-m-Y') }}</p>
        @else
            <p>Semua Data</p>
        @endif
    </div>

    <table class="table table-bordered table-striped">
        <thead class="table-light">
            <tr>
                <th>#</th>
                <th>Tanggal</th>
                <th class="text-end">Total Pemasukan</th>
                <th class="text-end">Total Pengeluaran</th>
                <th class="text-end">Saldo</th>
            </tr>
        </thead>
        <tbody>
            @forelse($rekap as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ \Carbon\Carbon::parse($item['tanggal'])->format('d-m-Y') }}</td>
                <td class="text-end">Rp {{ number_format($item['total_pemasukan'],0,',','.') }}</td>
                <td class="text-end">Rp {{ number_format($item['total_pengeluaran'],0,',','.') }}</td>
                <td class="text-end" style="color: {{ $item['saldo'] >= 0 ? 'green' : 'red' }};">
                    Rp {{ number_format($item['saldo'],0,',','.') }}
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center text-muted">Belum ada data</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-4">
        <p><strong>Total Saldo:</strong> Rp {{ number_format($rekap->sum('total_pemasukan') - $rekap->sum('total_pengeluaran'),0,',','.') }}</p>
    </div>

</div>

</body>
</html>
