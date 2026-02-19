<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PemasukanMasjid;
use App\Models\PengeluaranMasjid;
use App\Models\PemasukanSosial;
use App\Models\PengeluaranSosial;
use Carbon\Carbon;

class LaporanKasController extends Controller
{
    public function index(Request $request)
    {
        // Default tab is 'masjid' (Always local to Masjid now)
        $activeTab = 'masjid';
        
        // Date filters
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        // Default to current month if no filter
        if (!$startDate && !$endDate) {
            $startDate = Carbon::now()->startOfMonth()->format('Y-m-d');
            $endDate = Carbon::now()->endOfMonth()->format('Y-m-d');
        }

        $data = $this->getDataMasjid($startDate, $endDate);

        return view('laporan.index', array_merge($data, [
            'activeTab' => $activeTab,
            'startDate' => $startDate,
            'endDate' => $endDate
        ]));
    }


    public function cetak(Request $request)
    {
        // Copy logic from index, or reuse private method if possible. 
        // For simplicity, let's just reuse the logic but return a different view.
        
        $activeTab = $request->input('tab', 'masjid');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        if (!$startDate && !$endDate) {
            $startDate = Carbon::now()->startOfMonth()->format('Y-m-d');
            $endDate = Carbon::now()->endOfMonth()->format('Y-m-d');
        }

        $data = [];
        if ($activeTab == 'masjid') {
            $data = $this->getDataMasjid($startDate, $endDate);
        } else {
            $data = $this->getDataSosial($startDate, $endDate);
        }

        // For print, we usually want Ascending order (Oldest first)
        $data['rekaps'] = $data['rekaps']->sortBy([
            ['tanggal', 'asc'],
            ['id', 'asc']
        ]);

        return view('laporan.cetak', array_merge($data, [
            'activeTab' => $activeTab,
            'startDate' => $startDate,
            'endDate' => $endDate
        ]));
    }


    public function exportExcel(Request $request)
    {
        $activeTab = $request->input('tab', 'masjid');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        if (!$startDate && !$endDate) {
            $startDate = Carbon::now()->startOfMonth()->format('Y-m-d');
            $endDate = Carbon::now()->endOfMonth()->format('Y-m-d');
        }

        $data = [];
        if ($activeTab == 'masjid') {
            $data = $this->getDataMasjid($startDate, $endDate);
        } else {
            $data = $this->getDataSosial($startDate, $endDate);
        }

        // Sort Ascending for report
        $data['rekaps'] = $data['rekaps']->sortBy([
            ['tanggal', 'asc'],
            ['id', 'asc']
        ]);

        $filename = 'laporan_kas_' . $activeTab . '_' . date('Y-m-d_H-i') . '.xls';
        
        header("Content-Type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=\"$filename\"");
        
        return view('laporan.cetak', array_merge($data, [
            'activeTab' => $activeTab,
            'startDate' => $startDate,
            'endDate' => $endDate
        ]));
    }

    private function getDataMasjid($startDate, $endDate)
    {
        $pemasukanQuery = PemasukanMasjid::query();
        $pengeluaranQuery = PengeluaranMasjid::query();

        if ($startDate) {
            $pemasukanQuery->where('tanggal', '>=', $startDate);
            $pengeluaranQuery->where('tanggal', '>=', $startDate);
        }
        if ($endDate) {
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

        return $this->processData($pemasukan, $pengeluaran);
    }

    private function getDataSosial($startDate, $endDate)
    {
        $pemasukanQuery = PemasukanSosial::query();
        $pengeluaranQuery = PengeluaranSosial::query();

        if ($startDate) {
            $pemasukanQuery->where('tanggal', '>=', $startDate);
            $pengeluaranQuery->where('tanggal', '>=', $startDate);
        }
        if ($endDate) {
            $pemasukanQuery->where('tanggal', '<=', $endDate);
            $pengeluaranQuery->where('tanggal', '<=', $endDate);
        }

        $pemasukan = $pemasukanQuery->get()->map(function ($item) {
            $item->jenis = 'pemasukan';
            $clean_val = preg_replace('/[^\d]/', '', $item->jumlah);
            $item->jumlah = (int) $clean_val;
            return $item;
        });

        $pengeluaran = $pengeluaranQuery->get()->map(function ($item) {
            $item->jenis = 'pengeluaran';
            $clean_val = preg_replace('/[^\d]/', '', $item->nominal);
            $item->jumlah = (int) $clean_val;
            return $item;
        });

        return $this->processData($pemasukan, $pengeluaran);
    }

    private function processData($pemasukan, $pengeluaran)
    {
        // Combined and Sorted for Calculation
        $rekaps = $pemasukan->concat($pengeluaran)->sortBy([
            ['tanggal', 'asc'],
            ['id', 'asc']
        ]);

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
            $rekap->saldo_akhir = $saldo;
        }

        // Return latest first for display
        $rekapsDesc = $rekaps->sortByDesc([
            ['tanggal', 'desc'],
            ['id', 'desc']
        ]);

        return [
            'rekaps' => $rekapsDesc,
            'totalPemasukan' => $totalPemasukan,
            'totalPengeluaran' => $totalPengeluaran,
            'saldo' => $saldo,
        ];
    }
}
