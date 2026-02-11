<?php

namespace App\Http\Controllers;

use App\Models\Donasi;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RekapDonasiController extends Controller
{
    public function index(Request $request)
    {
        $query = Donasi::query();

        // Default: Show current month if no filter
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $startDate = Carbon::parse($request->start_date)->startOfDay();
            $endDate = Carbon::parse($request->end_date)->endOfDay();
            $query->whereBetween('tanggal_donasi', [$startDate, $endDate]);
        } else {
            // Default to this month
            // $query->whereMonth('tanggal_donasi', Carbon::now()->month)
            //       ->whereYear('tanggal_donasi', Carbon::now()->year);
            // Or just latest? Let's show all latest by default, maybe better
        }

        // Only show successful donations for Recap
        $query->where('status', 'success');

        // Get summaries for cards
        $summary = clone $query;
        $totalDonasi = $summary->sum('jumlah');
        $totalMasjid = $summary->where('jenis_donasi', 'masjid')->sum('jumlah');
        
        $summarySosial = clone $query; // Reset for filter
        // We need to re-apply basic filter because clone keeps previous 'where'
        // Actually simplest way is separate queries or conditional sum
        // But using same query base is safer for date filters.
        
        // Re-query for specific totals content based on main filter
        $donasis = $query->latest('tanggal_donasi')->get();
        
        $totalMasjid = $donasis->where('jenis_donasi', 'masjid')->sum('jumlah');
        $totalSosial = $donasis->where('jenis_donasi', 'sosial')->sum('jumlah');

        return view('rekap_donasi.index', compact('donasis', 'totalDonasi', 'totalMasjid', 'totalSosial'));
    }

    public function cetak(Request $request)
    {
        $query = Donasi::where('status', 'success');

        if ($request->filled('start_date') && $request->filled('end_date')) {
            $startDate = Carbon::parse($request->start_date)->startOfDay();
            $endDate = Carbon::parse($request->end_date)->endOfDay();
            $query->whereBetween('tanggal_donasi', [$startDate, $endDate]);
            $periode = Carbon::parse($request->start_date)->format('d/m/Y') . ' - ' . Carbon::parse($request->end_date)->format('d/m/Y');
        } else {
            $periode = 'Semua Waktu';
        }

        $donasis = $query->oldest('tanggal_donasi')->get();
        $totalDonasi = $donasis->sum('jumlah');

        return view('rekap_donasi.cetak', compact('donasis', 'totalDonasi', 'periode'));
    }
}
