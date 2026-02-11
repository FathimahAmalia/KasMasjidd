<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PemasukanMasjid;
use App\Models\PengeluaranMasjid;
use Carbon\Carbon;

class RekapKasController extends Controller
{
    public function index(Request $request)
    {
        $data = $this->getData($request);
        return view('rekap_kas.index', $data);
    }

    public function cetak(Request $request)
    {
        $data = $this->getData($request);
        return view('rekap_kas.cetak', $data);
    }

    public function exportExcel(Request $request)
    {
        $data = $this->getData($request);
        
        $filename = 'rekap_kas_masjid_' . date('Y-m-d_H-i') . '.xls';
        
        header("Content-Type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=\"$filename\"");
        
        return view('rekap_kas.cetak', $data);
    }



    private function getData(Request $request)
    {
        // Ambil filter tanggal dari request
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        // Jika tidak ada filter, default ke bulan ini
        if (!$startDate && !$endDate) {
            $startDate = Carbon::now()->startOfMonth()->format('Y-m-d');
            $endDate = Carbon::now()->endOfMonth()->format('Y-m-d');
        }

        $pemasukanQuery = PemasukanMasjid::query();
        $pengeluaranQuery = PengeluaranMasjid::query();

        if ($startDate && $endDate) {
            $pemasukanQuery->whereBetween('tanggal', [$startDate, $endDate]);
            $pengeluaranQuery->whereBetween('tanggal', [$startDate, $endDate]);
        } elseif ($startDate) {
            $pemasukanQuery->where('tanggal', '>=', $startDate);
            $pengeluaranQuery->where('tanggal', '>=', $startDate);
        } elseif ($endDate) {
            $pemasukanQuery->where('tanggal', '<=', $endDate);
            $pengeluaranQuery->where('tanggal', '<=', $endDate);
        }

        $pemasukan = $pemasukanQuery->get()->map(function ($item) {
            $item->jenis = 'pemasukan';
            $item->jumlah = (int) $item->nominal;
            return $item;
        });

        $pengeluaran = $pengeluaranQuery->get()->map(function ($item) {
            $item->jenis = 'pengeluaran';
            $item->jumlah = (int) $item->nominal;
            return $item;
        });

        // Gabungkan dan urutkan berdasarkan tanggal lalu ID (untuk stabilitas)
        $rekaps = $pemasukan->concat($pengeluaran)->sortBy([
            ['tanggal', 'asc'],
            ['id', 'asc']
        ]);

        // Hitung total dan saldo berjalan
        $totalPemasukan = 0;
        $totalPengeluaran = 0;
        $saldo = 0;

        foreach ($rekaps as $rekap) {
            if ($rekap->jenis == 'pemasukan') {
                $totalPemasukan += $rekap->jumlah;
                $saldo += $rekap->jumlah;
            } else {
                $totalPengeluaran += $rekap->jumlah;
                $saldo -= $rekap->jumlah;
            }
            // Simpan saldo walking balance
            $rekap->saldo_akhir = $saldo;
        }

        $rekapsDesc = $rekaps->sortByDesc('tanggal'); // For Index (Latest First)
        $rekapsAsc = $rekaps->sortBy('tanggal'); // For Print/Excel (Chronological)

        return [
            'rekaps' => $rekapsDesc,
            'rekapsCetak' => $rekapsAsc,
            'totalPemasukan' => $totalPemasukan,
            'totalPengeluaran' => $totalPengeluaran,
            'saldo' => $saldo,
            'startDate' => $startDate,
            'endDate' => $endDate
        ];
    }
}
