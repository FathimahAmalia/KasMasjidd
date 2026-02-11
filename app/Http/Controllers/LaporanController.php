<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PemasukanMasjid;
use App\Models\PengeluaranMasjid;
use App\Models\PemasukanSosial;
use App\Models\PengeluaranSosial;
use Carbon\Carbon;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        // Periode default: bulan ini
        $startDate = $request->get('start_date', Carbon::now()->startOfMonth()->format('Y-m-d'));
        $endDate = $request->get('end_date', Carbon::now()->endOfMonth()->format('Y-m-d'));

        // Data untuk grafik bulanan (12 bulan terakhir)
        $monthlyData = [];
        for ($i = 11; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $monthName = $date->format('M Y');

            $masukMasjid = PemasukanMasjid::whereYear('tanggal', $date->year)
                ->whereMonth('tanggal', $date->month)
                ->sum('nominal');

            $keluarMasjid = PengeluaranMasjid::whereYear('tanggal', $date->year)
                ->whereMonth('tanggal', $date->month)
                ->sum('nominal');

            $masukSosial = PemasukanSosial::whereYear('tanggal', $date->year)
                ->whereMonth('tanggal', $date->month)
                ->sum('jumlah');

            $keluarSosial = PengeluaranSosial::whereYear('tanggal', $date->year)
                ->whereMonth('tanggal', $date->month)
                ->sum('nominal');

            $monthlyData[] = [
                'month' => $monthName,
                'pemasukan_masjid' => $masukMasjid,
                'pengeluaran_masjid' => $keluarMasjid,
                'pemasukan_sosial' => $masukSosial,
                'pengeluaran_sosial' => $keluarSosial,
                'total_masuk' => $masukMasjid + $masukSosial,
                'total_keluar' => $keluarMasjid + $keluarSosial,
                'net' => ($masukMasjid + $masukSosial) - ($keluarMasjid + $keluarSosial)
            ];
        }

        // Data periode tertentu
        $pemasukanMasjid = PemasukanMasjid::whereBetween('tanggal', [$startDate, $endDate])->sum('nominal');
        $pengeluaranMasjid = PengeluaranMasjid::whereBetween('tanggal', [$startDate, $endDate])->sum('nominal');
        $pemasukanSosial = PemasukanSosial::whereBetween('tanggal', [$startDate, $endDate])->sum('jumlah');
        $pengeluaranSosial = PengeluaranSosial::whereBetween('tanggal', [$startDate, $endDate])->sum('nominal');

        $totalMasuk = $pemasukanMasjid + $pemasukanSosial;
        $totalKeluar = $pengeluaranMasjid + $pengeluaranSosial;
        $saldoNet = $totalMasuk - $totalKeluar;

        // Data untuk grafik pie (distribusi pengeluaran)
        $pengeluaranCategories = [
            'Masjid' => $pengeluaranMasjid,
            'Sosial' => $pengeluaranSosial
        ];

        return view('laporan.index', compact(
            'monthlyData',
            'pemasukanMasjid',
            'pengeluaranMasjid',
            'pemasukanSosial',
            'pengeluaranSosial',
            'totalMasuk',
            'totalKeluar',
            'saldoNet',
            'pengeluaranCategories',
            'startDate',
            'endDate'
        ));
    }
}
