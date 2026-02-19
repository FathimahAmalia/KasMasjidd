<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ContactItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contactItems = \App\Models\ContactItem::orderBy('order')->get();
        return view('admin.contact-items.index', compact('contactItems'));
    }

    public function create()
    {
        return view('admin.contact-items.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'label' => 'required|string|max:255',
            'value' => 'required|string|max:255',
            'order' => 'required|integer',
        ]);

        \App\Models\ContactItem::create($request->all());

        return redirect()->route('admin.contact-items.index')
            ->with('success', 'Kontak berhasil ditambahkan.');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $contactItem = \App\Models\ContactItem::findOrFail($id);
        return view('admin.contact-items.edit', compact('contactItem'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'label' => 'required|string|max:255',
            'value' => 'required|string|max:255',
            'order' => 'required|integer',
        ]);

        $contactItem = \App\Models\ContactItem::findOrFail($id);
        $contactItem->update($request->all());

        return redirect()->route('admin.contact-items.index')
            ->with('success', 'Kontak berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $contactItem = \App\Models\ContactItem::findOrFail($id);
        $contactItem->delete();

        return redirect()->route('admin.contact-items.index')
            ->with('success', 'Kontak berhasil dihapus.');
    }
}
