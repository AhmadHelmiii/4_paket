<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LogAktivitas;
use App\Models\User;
use Illuminate\Http\Request;

class LogAktivitasController extends Controller
{
    public function index(Request $request)
    {
        $query = LogAktivitas::with('user')->latest();

        if ($request->filled('user_id')) {
            $query->where('user_id', $request->user_id);
        }
        if ($request->filled('aksi')) {
            $query->where('aksi', $request->aksi);
        }
        if ($request->filled('tgl_mulai')) {
            $query->whereDate('created_at', '>=', $request->tgl_mulai);
        }
        if ($request->filled('tgl_selesai')) {
            $query->whereDate('created_at', '<=', $request->tgl_selesai);
        }

        $logs  = $query->paginate(20)->withQueryString();
        $users = User::orderBy('name')->get();

        return view('admin.log.index', compact('logs', 'users'));
    }
}
