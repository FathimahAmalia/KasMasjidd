<?php

namespace App\Http\Controllers;

use App\Models\PemasukanMasjid;
use App\Models\PengeluaranMasjid;
use Illuminate\Http\Request;

class PengeluaranMasjidController extends Controller
{
    public function index()
    {
        $data = PengeluaranMasjid::latest()->get();
        $total = $data->sum('nominal');
        
        // Calculate balance for reference
        $totalPemasukan = PemasukanMasjid::sum('nominal');
        $saldo = $totalPemasukan - $total;

        return view('pengeluaran_masjid.index', compact('data', 'total', 'saldo'));
    }

public function store(Request $request)
{
    // Validasi input
    $request->validate([
        'tanggal' => 'required|date',
        'jenis_pengeluaran' => 'required|string',
        'nominal' => 'required|string',
        'keterangan' => 'nullable|string',
    ]);

    // Remove all non-numeric characters from nominal
    $nominal = preg_replace('/[^\d]/', '', $request->nominal);
    
    // Validate that nominal is a valid number
    if (!is_numeric($nominal) || $nominal <= 0) {
        return redirect()->back()->withErrors(['nominal' => 'Nominal harus berupa angka yang valid']);
    }

    // Simpan ke Kas Masjid
    PengeluaranMasjid::create([
        'tanggal' => $request->tanggal,
        'jenis_pengeluaran' => $request->jenis_pengeluaran,
        'nominal' => (int)$nominal,
        'keterangan' => $request->keterangan,
    ]);

    return redirect()
        ->route('pengeluaran_masjid.index')
        ->with('success', 'Pengeluaran berhasil ditambahkan ke Kas Masjid');
}
    public function update(Request $request, $id)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'jenis_pengeluaran' => 'required|string',
            'nominal' => 'required|string',
            'keterangan' => 'nullable|string',
        ]);

        // Remove all non-numeric characters from nominal
        $nominal = preg_replace('/[^\d]/', '', $request->nominal);
        
        // Validate that nominal is a valid number
        if (!is_numeric($nominal) || $nominal <= 0) {
            return redirect()->back()->withErrors(['nominal' => 'Nominal harus berupa angka yang valid']);
        }

        $data = PengeluaranMasjid::findOrFail($id);
        $data->update([
            'tanggal' => $request->tanggal,
            'jenis_pengeluaran' => $request->jenis_pengeluaran,
            'nominal' => (int)$nominal,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->back()->with('success', 'Pengeluaran berhasil diperbarui');
    }

    public function destroy($id)
    {
        PengeluaranMasjid::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Pengeluaran berhasil dihapus');
    }

}
