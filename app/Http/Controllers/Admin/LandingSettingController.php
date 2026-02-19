<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LandingSettingController extends Controller
{
    public function index()
    {
        $settings = \App\Models\LandingSetting::all()->pluck('value', 'key');
        // Activities for the 3rd card
        $activities = \App\Models\RoutineActivity::all();
        
        return view('admin.settings.index', compact('settings', 'activities'));
    }

    public function update(Request $request)
    {
        $inputs = $request->except(['_token', '_method']);

        foreach ($inputs as $key => $value) {
            \App\Models\LandingSetting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }

        if ($request->hasFile('about_image')) {
            $path = $request->file('about_image')->store('settings', 'public');
            \App\Models\LandingSetting::updateOrCreate(
                ['key' => 'about_image'],
                ['value' => $path, 'type' => 'image']
            );
        }

        return redirect()->back()->with('success', 'Pengaturan berhasil diperbarui!');
    }}
