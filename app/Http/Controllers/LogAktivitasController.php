<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TbLogAktivitas;

class LogAktivitasController extends Controller
{
    public function index(Request $request)
    {
        $query = TbLogAktivitas::with('user');

        if ($request->filled('search')) {
            $query->where('aktivitas', 'like', '%'.$request->search.'%')
                  ->orWhereHas('user', fn($q) => $q->where('nama_lengkap', 'like', '%'.$request->search.'%'));
        }

        if ($request->filled('role')) {
            $query->whereHas('user', fn($q) => $q->where('role', $request->role));
        }

        $logs = $query->orderByDesc('waktu_aktivitas')->paginate(20)->withQueryString();
        return view('admin.log.index', compact('logs'));
    }
}
