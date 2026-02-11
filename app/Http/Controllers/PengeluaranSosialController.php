<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PengeluaranSosial;
use App\Models\PemasukanSosial;

class PengeluaranSosialController extends Controller
{
    public function index()
    {
        $data = PengeluaranSosial::orderBy('tanggal','desc')->get();
        $total = $data->sum('nominal');
        
        // Calculate balance for reference
        $totalPemasukan = PemasukanSosial::sum('jumlah');
        $saldo = $totalPemasukan - $total;

        return view('pengeluaran_sosial.index', compact('data','total','saldo'));
    }

    public function show($id)
    {
        return redirect()->route('pengeluaran-sosial.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'jenis_pengeluaran' => 'required|string|max:255',
            'nominal' => 'required|string',
        ]);

        $nominal = preg_replace('/[^\d]/', '', $request->nominal);
        $nominal = (int) $nominal;

        // Validasi nominal > 0
        if ($nominal <= 0) {
            return redirect()->back()->with('error', 'Nominal harus lebih dari 0');
        }

        // Calculate current balance from RekapKasSosial (total pemasukan - total pengeluaran)
        $totalPemasukan = PemasukanSosial::sum('jumlah');
        $totalPengeluaran = PengeluaranSosial::sum('nominal');
        $currentBalance = $totalPemasukan - $totalPengeluaran;

        if ($currentBalance < $nominal) {
            return redirect()->back()->with('error', 'Saldo kas sosial tidak mencukupi. Saldo: Rp ' . number_format($currentBalance, 0, ',', '.'));
        }

        PengeluaranSosial::create([
            'tanggal' => $request->tanggal,
            'jenis_pengeluaran' => $request->jenis_pengeluaran,
            'nominal' => $nominal,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->back()->with('success', 'Pengeluaran berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $item = PengeluaranSosial::findOrFail($id);

        $request->validate([
            'tanggal' => 'required|date',
            'jenis_pengeluaran' => 'required|string|max:255',
            'nominal' => 'required|string',
        ]);

        $nominalBaru = preg_replace('/[^\d]/', '', $request->nominal);
        $nominalBaru = (int) $nominalBaru;

        // Validasi nominal > 0
        if ($nominalBaru <= 0) {
            return redirect()->back()->with('error', 'Nominal harus lebih dari 0');
        }

        // Calculate current balance
        $totalPemasukan = PemasukanSosial::sum('jumlah');
        $totalPengeluaran = PengeluaranSosial::sum('nominal');
        // Exclude current item from old balance calculation
        $currentBalance = $totalPemasukan - ($totalPengeluaran - $item->nominal);

        if ($currentBalance < $nominalBaru) {
            return redirect()->back()->with('error', 'Saldo kas sosial tidak mencukupi untuk update. Saldo: Rp ' . number_format($currentBalance, 0, ',', '.'));
        }

        $item->update([
            'tanggal' => $request->tanggal,
            'jenis_pengeluaran' => $request->jenis_pengeluaran,
            'nominal' => $nominalBaru,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->back()->with('success', 'Pengeluaran berhasil diupdate');
    }

    public function destroy($id)
    {
        $item = PengeluaranSosial::findOrFail($id);
        $item->delete();

        return redirect()->back()->with('success', 'Pengeluaran berhasil dihapus');
    }
}
