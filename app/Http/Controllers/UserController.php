<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Show the form for creating a new user.
     */
    public function create()
    {
        // Check if user is admin
        $user = Auth::user();
        if (!$user || !$user->hasRole('admin')) {
            return redirect()->back()->with('error', 'Anda tidak memiliki akses untuk menambah pengguna');
        }

        $roles = Role::all();
        return view('users.create', compact('roles'));
    }

    /**
     * Store a newly created user in storage.
     */
    public function store(Request $request)
    {
        // Check if user is admin
        $user = Auth::user();
        if (!$user || !$user->hasRole('admin')) {
            return redirect()->back()->with('error', 'Anda tidak memiliki akses untuk menambah pengguna');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'roles' => 'required|array',
            'roles.*' => 'exists:roles,id'
        ], [
            'name.required' => 'Nama pengguna wajib diisi',
            'name.string' => 'Nama harus berupa teks',
            'name.max' => 'Nama tidak boleh lebih dari 255 karakter',
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Format email tidak valid',
            'email.unique' => 'Email sudah terdaftar',
            'password.required' => 'Password wajib diisi',
            'password.min' => 'Password minimal 6 karakter',
            'password.confirmed' => 'Konfirmasi password tidak sesuai',
            'roles.required' => 'Pilih minimal satu role',
        ]);

        // Create user
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        // Assign roles
        $user->roles()->attach($validated['roles']);

        return redirect()->route('users.index')
            ->with('success', 'Pengguna berhasil ditambahkan');
    }

    /**
     * Display a listing of all users.
     */
    public function index()
    {
        // Check if user is admin
        $user = Auth::user();
        if (!$user || !$user->hasRole('admin')) {
            return redirect()->back()->with('error', 'Anda tidak memiliki akses untuk melihat daftar pengguna');
        }

        $users = User::with('roles')->get();
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for editing the specified user.
     */
    public function edit(User $user)
    {
        // Check if user is admin
        $authUser = Auth::user();
        if (!$authUser || !$authUser->hasRole('admin')) {
            return redirect()->back()->with('error', 'Anda tidak memiliki akses untuk mengedit pengguna');
        }

        $roles = Role::all();
        $userRoles = $user->roles->pluck('id')->toArray();
        return view('users.edit', compact('user', 'roles', 'userRoles'));
    }

    /**
     * Update the specified user in storage.
     */
    public function update(Request $request, User $user)
    {
        // Check if user is admin
        $authUser = Auth::user();
        if (!$authUser || !$authUser->hasRole('admin')) {
            return redirect()->back()->with('error', 'Anda tidak memiliki akses untuk mengedit pengguna');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:6|confirmed',
            'roles' => 'required|array',
            'roles.*' => 'exists:roles,id'
        ], [
            'name.required' => 'Nama pengguna wajib diisi',
            'email.required' => 'Email wajib diisi',
            'email.unique' => 'Email sudah terdaftar',
            'password.min' => 'Password minimal 6 karakter',
            'password.confirmed' => 'Konfirmasi password tidak sesuai',
            'roles.required' => 'Pilih minimal satu role',
        ]);

        $user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
        ]);

        if ($request->filled('password')) {
            $user->update(['password' => Hash::make($validated['password'])]);
        }

        $user->roles()->sync($validated['roles']);

        return redirect()->route('users.index')
            ->with('success', 'Pengguna berhasil diperbarui');
    }

    /**
     * Remove the specified user from storage.
     */
    public function destroy(User $user)
    {
        // Check if user is admin
        $authUser = Auth::user();
        if (!$authUser || !$authUser->hasRole('admin')) {
            return redirect()->back()->with('error', 'Anda tidak memiliki akses untuk menghapus pengguna');
        }

        // Prevent deleting self
        if (Auth::id() === $user->id) {
            return redirect()->back()->with('error', 'Anda tidak dapat menghapus akun sendiri');
        }

        $user->roles()->detach();
        $user->delete();

        return redirect()->route('users.index')
            ->with('success', 'Pengguna berhasil dihapus');
    }
}
