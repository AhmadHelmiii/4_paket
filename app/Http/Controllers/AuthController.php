<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\TbLogAktivitas;

class AuthController extends Controller
{
    public function showLogin()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $credentials = [
            'username'     => $request->username,
            'password'     => $request->password,
            'status_aktif' => 1,
        ];

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            TbLogAktivitas::catat(Auth::id(), 'Login ke sistem');
            return redirect()->route('dashboard');
        }

        return back()->withErrors([
            'username' => 'Username atau password salah, atau akun tidak aktif.',
        ])->withInput($request->only('username'));
    }

    public function logout(Request $request)
    {
        TbLogAktivitas::catat(Auth::id(), 'Logout dari sistem');
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
