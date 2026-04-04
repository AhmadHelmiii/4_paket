<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\LogAktivitas;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;

class UserController extends Controller
{
    public function index()
    {
        $users = User::latest()->paginate(10);
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'      => 'required|string|max:100',
            'email'     => 'required|email|unique:users',
            'password'  => ['required', Rules\Password::min(8)],
            'role'      => 'required|in:admin,petugas,peminjam',
            'is_active' => 'boolean',
        ]);

        $user = User::create([
            'name'      => $request->name,
            'email'     => $request->email,
            'password'  => $request->password,
            'role'      => $request->role,
            'is_active' => $request->boolean('is_active', true),
        ]);

        LogAktivitas::catat('create', 'users', $user->id, "Tambah user: {$user->name}");

        return redirect()->route('admin.users.index')->with('success', 'User berhasil ditambahkan.');
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name'      => 'required|string|max:100',
            'email'     => 'required|email|unique:users,email,' . $user->id,
            'password'  => ['nullable', Rules\Password::min(8)],
            'role'      => 'required|in:admin,petugas,peminjam',
            'is_active' => 'boolean',
        ]);

        $user->update([
            'name'      => $request->name,
            'email'     => $request->email,
            'role'      => $request->role,
            'is_active' => $request->boolean('is_active', true),
            ...($request->filled('password') ? ['password' => $request->password] : []),
        ]);

        LogAktivitas::catat('update', 'users', $user->id, "Update user: {$user->name}");

        return redirect()->route('admin.users.index')->with('success', 'User berhasil diperbarui.');
    }

    public function destroy(User $user)
    {
        if ($user->id === auth()->id()) {
            return back()->with('error', 'Tidak bisa menghapus akun sendiri.');
        }

        LogAktivitas::catat('delete', 'users', $user->id, "Hapus user: {$user->name}");
        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'User berhasil dihapus.');
    }

    public function toggleActive(User $user)
    {
        $user->update(['is_active' => !$user->is_active]);
        LogAktivitas::catat('update', 'users', $user->id, "Toggle aktif user: {$user->name}");
        return back()->with('success', 'Status user diperbarui.');
    }
}
