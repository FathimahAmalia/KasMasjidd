<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PublicActivityController extends Controller
{
    public function index()
    {
        $activities = \App\Models\Activity::where('is_active', true)->latest()->paginate(9);
        $settings = \App\Models\LandingSetting::pluck('value', 'key');
        return view('kegiatan.index', compact('activities', 'settings'));
    }
}
