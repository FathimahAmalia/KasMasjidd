<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InformasiController extends Controller
{
    public function index()
    {
        // 1. Fetch Settings
        $settings = \App\Models\LandingSetting::pluck('value', 'key');
        
        // 2. Fetch Routine Activities (for the 3rd card)
        $activities = \App\Models\RoutineActivity::where('is_active', true)->get();

        return view('informasi.index', compact('settings', 'activities'));
    }
}
