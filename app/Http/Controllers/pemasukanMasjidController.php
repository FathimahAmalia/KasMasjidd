<?php

namespace App\Http\Controllers;

use App\Models\PemasukanMasjid;
use App\Models\PengeluaranMasjid;
use Illuminate\Http\Request;

class pemasukanMasjidController extends Controller
{
   
     public function index()
{
    $totalPemasukan = PemasukanMasjid::sum('nominal');
    $totalPengeluaran = PengeluaranMasjid::sum('nominal');
    $saldo = $totalPemasukan - $totalPengeluaran;

    $data = PemasukanMasjid::latest('id')->get();

    return view('pemasukan_masjid.index', compact(
        'totalPemasukan',
        'totalPengeluaran',
        'saldo',
        'data'
    ));
}

      public function store(Request $request)
    {
        $request->validate([
            'tanggal'     => 'required|date',
            'sumber_dana' => 'required|string',
            'nominal'     => 'required|string',
        ]);

        // Remove all non-numeric characters from nominal
        $nominal = preg_replace('/[^\d]/', '', $request->nominal);
        
        // Validate that nominal is a valid number
        if (!is_numeric($nominal) || $nominal <= 0) {
            return redirect()->back()->withErrors(['nominal' => 'Nominal harus berupa angka yang valid']);
        }

        // Simpan ke Kas Masjid
        PemasukanMasjid::create([
            'tanggal'     => $request->tanggal,
            'sumber_dana' => $request->sumber_dana,
            'keterangan'  => $request->keterangan,
            'nominal'     => (int)$nominal,
        ]);

        return redirect()->back()->with('success', 'Pemasukan berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'tanggal'     => 'required|date',
            'sumber_dana' => 'required|string',
            'nominal'     => 'required|string',
        ]);

        // Remove all non-numeric characters from nominal
        $nominal = preg_replace('/[^\d]/', '', $request->nominal);
        
        // Validate that nominal is a valid number
        if (!is_numeric($nominal) || $nominal <= 0) {
            return redirect()->back()->withErrors(['nominal' => 'Nominal harus berupa angka yang valid']);
        }

        $data = PemasukanMasjid::findOrFail($id);

        $data->update([
            'tanggal'     => $request->tanggal,
            'sumber_dana' => $request->sumber_dana,
            'keterangan'  => $request->keterangan,
            'nominal'     => (int)$nominal,
        ]);

        return redirect()->back()->with('success', 'Pemasukan berhasil diperbarui');
    }

     public function destroy($id)
    {
        $data = PemasukanMasjid::findOrFail($id);
        $data->delete();

        return redirect()->back()->with('success', 'Pemasukan berhasil dihapus');
    }
}

