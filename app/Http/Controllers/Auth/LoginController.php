<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Traits\LogsActivity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use LogsActivity;

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required|min:8',
        ], [
            'email.required'    => 'Email wajib diisi.',
            'email.email'       => 'Format email tidak valid.',
            'password.required' => 'Password wajib diisi.',
            'password.min'      => 'Password minimal 8 karakter.',
        ]);

        $credentials = $request->only('email', 'password');

        if (!Auth::attempt($credentials, $request->boolean('remember'))) {
            return back()->withErrors(['email' => 'Email atau password salah.'])->withInput();
        }

        $user = Auth::user();

        if (!$user->is_active) {
            Auth::logout();
            return back()->withErrors(['email' => 'Akun Anda tidak aktif. Hubungi administrator.'])->withInput();
        }

        $request->session()->regenerate();
        $this->logAktivitas('login', 'users', $user->id, 'Login berhasil');

        return match ($user->role) {
            'admin'    => redirect()->route('admin.dashboard'),
            'petugas'  => redirect()->route('petugas.dashboard'),
            'peminjam' => redirect()->route('peminjam.dashboard'),
            default    => redirect('/'),
        };
    }

    public function logout(Request $request)
    {
        $this->logAktivitas('logout', 'users', Auth::id(), 'Logout');
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
