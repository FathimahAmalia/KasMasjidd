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
        $totalPemasukanMasjid = PemasukanMasjid::sum('nominal');
        $totalPengeluaranMasjid = PengeluaranMasjid::sum('nominal');
        
        // 2. Hitung Saldo Masjid (Net)
        $saldoMasjid = $totalPemasukanMasjid - $totalPengeluaranMasjid;

        // 3. Total Aset (Sama dengan Saldo Masjid sekarang)
        $totalAset = $saldoMasjid;

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

        $recentTransactions = $pemasukanMasjid
            ->merge($pengeluaranMasjid)
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
                ->sum('nominal');

            $monthlyExpense = PengeluaranMasjid::whereYear('tanggal', $month->year)
                ->whereMonth('tanggal', $month->month)
                ->sum('nominal');

            $incomeData[] = $monthlyIncome;
            $expenseData[] = $monthlyExpense;
        }

        return view('home', compact(
            'totalPemasukanMasjid',
            'totalPengeluaranMasjid',
            'saldoMasjid', 
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
