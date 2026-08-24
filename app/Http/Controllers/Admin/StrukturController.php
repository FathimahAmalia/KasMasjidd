<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Struktur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StrukturController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | ADMIN INDEX
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $strukturs = Struktur::with('parent')
            ->orderBy('urutan', 'asc')
            ->orderBy('id', 'asc')
            ->get();

        return view('admin.struktur.index', compact('strukturs'));
    }


    /*
    |--------------------------------------------------------------------------
    | CREATE
    |--------------------------------------------------------------------------
    */

    public function create()
    {
        $parents = Struktur::orderBy('urutan')
            ->orderBy('id')
            ->get();

        return view('admin.struktur.create', compact('parents'));
    }


    /*
    |--------------------------------------------------------------------------
    | STORE
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        $request->validate([
            'parent_id' => 'nullable|exists:strukturs,id',
            'jabatan' => 'required|string|max:255',
            'nama' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'keterangan' => 'nullable|string',
            'urutan' => 'nullable|integer',
        ]);

        $data = [
            'parent_id' => $request->parent_id ?: null,
            'jabatan' => $request->jabatan,
            'nama' => $request->nama,
            'keterangan' => $request->keterangan,
            'urutan' => $request->urutan ?? 0,
            'status' => $request->has('status'),
        ];

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')
                ->store('struktur', 'public');
        }

        Struktur::create($data);

        return redirect()
            ->route('admin.struktur.index')
            ->with('success', 'Data struktur berhasil ditambahkan.');
    }


    /*
    |--------------------------------------------------------------------------
    | EDIT
    |--------------------------------------------------------------------------
    */

    public function edit(Struktur $struktur)
    {
        $parents = Struktur::where('id', '!=', $struktur->id)
            ->orderBy('urutan')
            ->orderBy('id')
            ->get();

        return view(
            'admin.struktur.edit',
            compact('struktur', 'parents')
        );
    }


    /*
    |--------------------------------------------------------------------------
    | UPDATE
    |--------------------------------------------------------------------------
    */

    public function update(Request $request, Struktur $struktur)
    {
        $request->validate([
            'parent_id' => 'nullable|exists:strukturs,id',
            'jabatan' => 'required|string|max:255',
            'nama' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'keterangan' => 'nullable|string',
            'urutan' => 'nullable|integer',
        ]);

        $data = [
            'parent_id' => $request->parent_id ?: null,
            'jabatan' => $request->jabatan,
            'nama' => $request->nama,
            'keterangan' => $request->keterangan,
            'urutan' => $request->urutan ?? 0,
            'status' => $request->has('status'),
        ];

        if ($request->hasFile('foto')) {

            if (
                $struktur->foto &&
                Storage::disk('public')->exists($struktur->foto)
            ) {
                Storage::disk('public')->delete($struktur->foto);
            }

            $data['foto'] = $request->file('foto')
                ->store('struktur', 'public');
        }

        $struktur->update($data);

        return redirect()
            ->route('admin.struktur.index')
            ->with('success', 'Data struktur berhasil diperbarui.');
    }


    /*
    |--------------------------------------------------------------------------
    | DELETE
    |--------------------------------------------------------------------------
    */

    public function destroy(Struktur $struktur)
    {
        if (
            $struktur->foto &&
            Storage::disk('public')->exists($struktur->foto)
        ) {
            Storage::disk('public')->delete($struktur->foto);
        }

        $struktur->delete();

        return redirect()
            ->route('admin.struktur.index')
            ->with('success', 'Data struktur berhasil dihapus.');
    }


    /*
    |--------------------------------------------------------------------------
    | PUBLIC
    |--------------------------------------------------------------------------
    */

    public function publicIndex()
    {
        $strukturs = Struktur::where('status', true)
            ->whereNull('parent_id')
            ->with('childrenRecursive')
            ->orderBy('urutan')
            ->orderBy('id')
            ->get();

        return view('struktur.index', compact('strukturs'));
    }
}