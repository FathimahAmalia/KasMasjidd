<?php

namespace App\Http\Controllers;

use App\Models\PemasukanSosial;
use App\Models\PengeluaranSosial;
use Illuminate\Http\Request;
use Carbon\Carbon;

class RekapKasSosialController extends Controller
{
    public function index(Request $request)
    {
        $data = $this->getData($request);
        return view('rekap_kas_sosial.index', $data);
    }

    public function cetak(Request $request)
    {
        $data = $this->getData($request);
        return view('rekap_kas_sosial.cetak', $data);
    }

    private function getData(Request $request)
    {
        // Ambil filter bulan & tahun dari request, default ke bulan ini jika tidak ada
        $bulanTahun = $request->input('bulan_tahun');

        $pemasukanQuery = PemasukanSosial::query();
        $pengeluaranQuery = PengeluaranSosial::query();

        if ($bulanTahun) {
            $date = Carbon::createFromFormat('Y-m', $bulanTahun);
            $pemasukanQuery->whereMonth('tanggal', $date->month)->whereYear('tanggal', $date->year);
            $pengeluaranQuery->whereMonth('tanggal', $date->month)->whereYear('tanggal', $date->year);
        }

        $pemasukan = $pemasukanQuery->get()->map(function ($item) {
            if (!$item) return null;
            $item->jenis = 'pemasukan';
            // Ensure any legacy formatting like "1.000.000" is cleaned before casting
            $clean_val = preg_replace('/[^\d]/', '', $item->jumlah);
            $item->jumlah = (int) $clean_val;
            return $item;
        })->filter();

        $pengeluaran = $pengeluaranQuery->get()->map(function ($item) {
            if (!$item) return null;
            $item->jenis = 'pengeluaran';
            // Mapping field agar seragam (di model PengeluaranSosial namanya 'nominal', di PemasukanSosial namanya 'jumlah')
            $clean_val = preg_replace('/[^\d]/', '', $item->nominal);
            $item->jumlah = (int) $clean_val; 
            return $item;
        })->filter();

        // Gabungkan dan urutkan berdasarkan tanggal lalu ID (untuk stabilitas)
        $rekaps = $pemasukan->concat($pengeluaran)->sortBy([
            ['tanggal', 'asc'],
            ['id', 'asc']
        ]);

        // Hitung total dan saldo berjalans
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
            // Simpan saldo walking balance di objek untuk ditampilkan di tabel
            $rekap->saldo_akhir = $saldo;
        }

        // Untuk view, kita mungkin ingin mengurutkan descending agar yang terbaru di atas,
        // TAPI saldo berjalan biasanya butuh urutan ascending.
        // Jika ingin ditampilkan Descending di tabel tapi saldo tetap benar,
        // logic saldo harus sudah diproses saat Ascending.
        // Default sort for display: Ascending (Oldest first) usually better for printed reports to read history?
        // Let's stick to Descending for Index as before, but maybe Ascending for Cetak? 
        // User asked for "like rekap", usually rekap is chronological.
        // Let's keep common logic returned sorted by Date ASC for consistency in calculation.
        // Controller index usually reverses it for display if needed.
        
        // Let's return sorted by SAA for logic, but let the view decide order or just return desc for index.
        
        $rekapsDesc = $rekaps->sortByDesc('tanggal'); // For Index View (Latest First)
        $rekapsAsc = $rekaps->sortBy('tanggal'); // For Print View (Chronological usually better)

        return [
            'rekaps' => $rekapsDesc, 
            'rekapsCetak' => $rekapsAsc,
            'totalPemasukan' => $totalPemasukan, 
            'totalPengeluaran' => $totalPengeluaran, 
            'saldo' => $saldo,
            'bulanTahun' => $bulanTahun // Pass filter info for title
        ];
    }
}
