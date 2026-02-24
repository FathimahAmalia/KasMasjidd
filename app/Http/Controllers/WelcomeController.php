<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PemasukanMasjid;
use App\Models\PengeluaranMasjid;
use App\Models\PemasukanSosial;
use App\Models\PengeluaranSosial;

class WelcomeController extends Controller
{
    public function index()
    {
        // Hitung total pemasukan kas masjid
        $totalPemasukanMasjid = PemasukanMasjid::sum('nominal');
        
        // Hitung total pengeluaran kas masjid
        $totalPengeluaranMasjid = PengeluaranMasjid::sum('nominal');
        
        // Hitung total saldo kas masjid (Net)
        $saldoMasjid = $totalPemasukanMasjid - $totalPengeluaranMasjid;

        // Fetch data dinamis
        $settings = \App\Models\LandingSetting::all()->pluck('value', 'key');
        $activities = \App\Models\Activity::where('is_active', true)->limit(6)->get();

        return view('welcome', compact('totalPemasukanMasjid', 'totalPengeluaranMasjid', 'saldoMasjid', 'settings', 'activities'));
    }
}
