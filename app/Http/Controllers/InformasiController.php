<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InformasiController extends Controller
{
    public function index()
    {
        $settings = \App\Models\LandingSetting::pluck('value', 'key');
        return view('informasi.index', compact('settings'));
    }
}
