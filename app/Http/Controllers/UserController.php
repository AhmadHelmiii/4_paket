<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\TbUser;
use App\Models\TbLogAktivitas;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = TbUser::query();

        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('nama_lengkap', 'like', '%'.$request->search.'%')
                  ->orWhere('username', 'like', '%'.$request->search.'%');
            });
        }

        if ($request->filled('role')) {
            $query->where('role', $request->role);
        }

        $users = $query->orderBy('nama_lengkap')->paginate(10)->withQueryString();
        return view('admin.user.index', compact('users'));
    }

    public function create()
    {
        return view('admin.user.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_lengkap' => 'required|string|max:50',
            'username'     => 'required|string|max:50|unique:tb_user,username',
            'password'     => 'required|string|min:6',
            'role'         => 'required|in:admin,petugas,owner',
        ]);

        TbUser::create([
            'nama_lengkap' => $request->nama_lengkap,
            'username'     => $request->username,
            'password'     => Hash::make($request->password),
            'role'         => $request->role,
            'status_aktif' => $request->boolean('status_aktif', true),
        ]);

        TbLogAktivitas::catat(Auth::id(), "Tambah user: {$request->username}");
        return redirect()->route('user.index')->with('success', 'User berhasil ditambahkan.');
    }

    public function edit(TbUser $user)
    {
        return view('admin.user.edit', compact('user'));
    }

    public function update(Request $request, TbUser $user)
    {
        $request->validate([
            'nama_lengkap' => 'required|string|max:50',
            'username'     => 'required|string|max:50|unique:tb_user,username,' . $user->id_user . ',id_user',
            'role'         => 'required|in:admin,petugas,owner',
        ]);

        $data = [
            'nama_lengkap' => $request->nama_lengkap,
            'username'     => $request->username,
            'role'         => $request->role,
            'status_aktif' => $request->boolean('status_aktif'),
        ];

        if ($request->filled('password')) {
            $request->validate(['password' => 'min:6']);
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);
        TbLogAktivitas::catat(Auth::id(), "Update user: {$user->username}");
        return redirect()->route('user.index')->with('success', 'User berhasil diperbarui.');
    }

    public function destroy(TbUser $user)
    {
        if ($user->id_user === Auth::id()) {
            return back()->with('error', 'Tidak bisa menghapus akun sendiri.');
        }
        TbLogAktivitas::catat(Auth::id(), "Hapus user: {$user->username}");
        $user->delete();
        return redirect()->route('user.index')->with('success', 'User berhasil dihapus.');
    }
}
