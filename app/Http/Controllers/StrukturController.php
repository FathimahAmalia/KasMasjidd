<?php

namespace App\Http\Controllers;

use App\Models\Struktur;

class StrukturController extends Controller
{
    /**
     * PUBLIC - Tampilan struktur masjid
     */
    public function index()
    {
        $strukturs = Struktur::where('status', true)
            ->orderBy('urutan', 'asc')
            ->orderBy('id', 'asc')
            ->get();

        return view('struktur.index', compact('strukturs'));
    }
}