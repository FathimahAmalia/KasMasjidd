<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class InformationComponentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $components = \App\Models\InformationComponent::orderBy('order')->get();
        return view('admin.information-components.index', compact('components'));
    }

    public function create()
    {
        return view('admin.information-components.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|in:text,prayer_times,routine_activities,contact_list',
            'order' => 'required|integer',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('components', 'public');
        }

        \App\Models\InformationComponent::create($data);

        return redirect()->route('admin.information-components.index')
            ->with('success', 'Komponen berhasil ditambahkan.');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $component = \App\Models\InformationComponent::findOrFail($id);
        return view('admin.information-components.edit', compact('component'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|in:text,prayer_times,routine_activities,contact_list',
            'order' => 'required|integer',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $component = \App\Models\InformationComponent::findOrFail($id);
        $data = $request->all();

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($component->image) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($component->image);
            }
            $data['image'] = $request->file('image')->store('components', 'public');
        }

        $component->update($data);

        return redirect()->route('admin.information-components.index')
            ->with('success', 'Komponen berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $component = \App\Models\InformationComponent::findOrFail($id);
        $component->delete();

        return redirect()->route('admin.information-components.index')
            ->with('success', 'Komponen berhasil dihapus.');
    }
}
