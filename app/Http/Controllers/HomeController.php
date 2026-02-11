<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PemasukanMasjid;
use App\Models\PengeluaranMasjid;
use App\Models\PemasukanSosial;
use App\Models\PengeluaranSosial;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // 1. Hitung Saldo Digital Masjid
        $masjidMasuk = PemasukanMasjid::sum('nominal');
        $masjidKeluar = PengeluaranMasjid::sum('nominal');
        $saldoMasjid = $masjidMasuk - $masjidKeluar;

        // 2. Hitung Saldo Sosial
        // Note: PemasukanSosial uses 'jumlah', PengeluaranSosial uses 'nominal' based on previous checks
        $sosialMasuk = PemasukanSosial::sum('jumlah'); 
        $sosialKeluar = PengeluaranSosial::sum('nominal');
        $saldoSosial = $sosialMasuk - $sosialKeluar;

        // 3. Total Aset
        $totalAset = $saldoMasjid + $saldoSosial;

        // 4. Transaksi Terakhir (Gabungan 4 Tabel)
        // Kita ambil 5 terakhir dari masing-masing, gabung, sort, ambil 5.
        // Cara ini agak kasar tapi efektif untuk dataset kecil.
        
        $pemasukanMasjid = PemasukanMasjid::latest('tanggal')->take(5)->get()->map(function($i){
            $i->jenis_transaksi = 'Pemasukan Masjid';
            $i->tipe = 'masuk';
            $i->nominal_display = $i->nominal;
            return $i;
        });
        
        $pengeluaranMasjid = PengeluaranMasjid::latest('tanggal')->take(5)->get()->map(function($i){
            $i->jenis_transaksi = 'Pengeluaran Masjid';
            $i->tipe = 'keluar';
            $i->nominal_display = $i->nominal;
            return $i;
        });

        $pemasukanSosial = PemasukanSosial::latest('tanggal')->take(5)->get()->map(function($i){
            $i->jenis_transaksi = 'Pemasukan Sosial';
            $i->tipe = 'masuk';
            $i->nominal_display = $i->jumlah;
            return $i;
        });

        $pengeluaranSosial = PengeluaranSosial::latest('tanggal')->take(5)->get()->map(function($i){
            $i->jenis_transaksi = 'Pengeluaran Sosial';
            $i->tipe = 'keluar';
            $i->nominal_display = $i->nominal;
            return $i;
        });

        $recentTransactions = $pemasukanMasjid
            ->merge($pengeluaranMasjid)
            ->merge($pemasukanSosial)
            ->merge($pengeluaranSosial)
            ->sortByDesc('tanggal')
            ->take(5);

        // Data untuk Grafik (12 Bulan Terakhir)
        $months = [];
        $incomeData = [];
        $expenseData = [];

        for ($i = 11; $i >= 0; $i--) {
            $month = Carbon::now()->subMonths($i);
            $months[] = $month->format('M Y');
            
            $monthlyIncome = PemasukanMasjid::whereYear('tanggal', $month->year)
                ->whereMonth('tanggal', $month->month)
                ->sum('nominal') + 
                PemasukanSosial::whereYear('tanggal', $month->year)
                ->whereMonth('tanggal', $month->month)
                ->sum('jumlah');

            $monthlyExpense = PengeluaranMasjid::whereYear('tanggal', $month->year)
                ->whereMonth('tanggal', $month->month)
                ->sum('nominal') + 
                PengeluaranSosial::whereYear('tanggal', $month->year)
                ->whereMonth('tanggal', $month->month)
                ->sum('nominal');

            $incomeData[] = $monthlyIncome;
            $expenseData[] = $monthlyExpense;
        }

        return view('home', compact(
            'saldoMasjid', 
            'saldoSosial', 
            'totalAset', 
            'recentTransactions',
            'months',
            'incomeData',
            'expenseData'
        ));
    }

      public function logout(Request $request)
    {
        Auth::logout(); 
        $request->session()->invalidate(); 
        $request->session()->regenerateToken(); 

        return redirect('/login');
    }
}
