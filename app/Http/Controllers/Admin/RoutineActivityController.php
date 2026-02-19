<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RoutineActivity;
use Illuminate\Http\Request;

class RoutineActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $activities = RoutineActivity::orderBy('created_at', 'desc')->get();
        return view('admin.routine-activities.index', compact('activities'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'icon' => 'nullable|string',
        ]);

        // Set default icon if not provided
        if (empty($validated['icon'])) {
            $validated['icon'] = 'bi-check-circle';
        }

        RoutineActivity::create($validated);

        return redirect()->route('routine-activities.index')
            ->with('success', 'Kegiatan rutin berhasil ditambahkan');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, RoutineActivity $routineActivity)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'icon' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        $routineActivity->update($validated);

        return redirect()->route('routine-activities.index')
            ->with('success', 'Kegiatan rutin berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RoutineActivity $routineActivity)
    {
        $routineActivity->delete();

        return redirect()->route('routine-activities.index')
            ->with('success', 'Kegiatan rutin berhasil dihapus');
    }
}
