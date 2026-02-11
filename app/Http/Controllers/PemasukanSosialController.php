<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PemasukanSosial;
use App\Models\PengeluaranSosial;

class PemasukanSosialController extends Controller
{
    public function index()
    {
        // Hitung total pemasukan
        $totalPemasukan = PemasukanSosial::sum('jumlah');
        
        // Hitung total pengeluaran
        $totalPengeluaran = PengeluaranSosial::sum('nominal');
        
        // Hitung saldo
        $saldo = $totalPemasukan - $totalPengeluaran;
        
        $pemasukan = PemasukanSosial::orderBy('tanggal', 'desc')->get();

        return view('pemasukan_sosial.index', [
            'pemasukan' => $pemasukan,
            'totalPemasukan' => $totalPemasukan,
            'saldo' => $saldo
        ]);
    }



    public function store(Request $request)
    {
        $request->validate([
            'tanggal'=>'required|date',
            'sumber_dana'=>'required|string|max:255',
            'jumlah'=>'required|string', 
        ]);

        $jumlah = preg_replace('/[^\d]/', '', $request->jumlah);
        $jumlah = (int) $jumlah;

        // Validasi nominal > 0
        if ($jumlah <= 0) {
            return redirect()->back()->with('error', 'Jumlah harus lebih dari 0');
        }

        PemasukanSosial::create([
            'tanggal'=>$request->tanggal,
            'sumber_dana'=>$request->sumber_dana,
            'jumlah'=>$jumlah,
            'keterangan'=>$request->keterangan,
        ]);

        return redirect()->back()->with('success','Pemasukan berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $item = PemasukanSosial::findOrFail($id);

        $request->validate([
            'tanggal'=>'required|date',
            'sumber_dana'=>'required|string|max:255',
            'jumlah'=>'required|string',
        ]);

        $jumlah = preg_replace('/[^\d]/', '', $request->jumlah);
        $jumlah = (int) $jumlah;

        // Validasi nominal > 0
        if ($jumlah <= 0) {
            return redirect()->back()->with('error', 'Jumlah harus lebih dari 0');
        }

        $item->update([
            'tanggal'=>$request->tanggal,
            'sumber_dana'=>$request->sumber_dana,
            'jumlah'=>$jumlah,
            'keterangan'=>$request->keterangan,
        ]);

        return redirect()->back()->with('success','Pemasukan berhasil diupdate');
    }

    public function destroy($id)
    {
        $item = PemasukanSosial::findOrFail($id);
        $item->delete();

        return redirect()->back()->with('success','Pemasukan berhasil dihapus');
    }
}
