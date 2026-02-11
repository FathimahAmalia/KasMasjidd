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
        // Hitung total saldo kas masjid
        $masjidMasuk = PemasukanMasjid::sum('nominal');
        $masjidKeluar = PengeluaranMasjid::sum('nominal');
        $saldoMasjid = $masjidMasuk - $masjidKeluar;

        // Hitung total saldo kas sosial
        $sosialMasuk = PemasukanSosial::sum('jumlah');
        $sosialKeluar = PengeluaranSosial::sum('nominal');
        $saldoSosial = $sosialMasuk - $sosialKeluar;

        // Total aset
        $totalAset = $saldoMasjid + $saldoSosial;

        // Hitung total pemasukan bulan ini
        $pemasukanBulanIni = PemasukanMasjid::whereMonth('tanggal', now()->month)
            ->whereYear('tanggal', now()->year)
            ->sum('nominal')
            + 
            PemasukanSosial::whereMonth('tanggal', now()->month)
            ->whereYear('tanggal', now()->year)
            ->sum('jumlah');

        // Fetch data dinamis
        $settings = \App\Models\LandingSetting::all()->pluck('value', 'key');
        $activities = \App\Models\Activity::where('is_active', true)->limit(6)->get();

        return view('welcome', compact('saldoMasjid', 'saldoSosial', 'totalAset', 'pemasukanBulanIni', 'settings', 'activities'));
    }
}
