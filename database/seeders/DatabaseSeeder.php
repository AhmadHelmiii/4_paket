<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\TbUser;
use App\Models\TbTarif;
use App\Models\TbAreaParkir;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Users
        $users = [
            ['nama_lengkap' => 'Administrator', 'username' => 'admin',   'password' => Hash::make('admin123'),   'role' => 'admin'],
            ['nama_lengkap' => 'Petugas Parkir', 'username' => 'petugas', 'password' => Hash::make('petugas123'), 'role' => 'petugas'],
            ['nama_lengkap' => 'Owner Parkir',   'username' => 'owner',   'password' => Hash::make('owner123'),   'role' => 'owner'],
        ];

        foreach ($users as $u) {
            TbUser::updateOrCreate(['username' => $u['username']], array_merge($u, ['status_aktif' => 1]));
        }

        // Tarif
        $tarifs = [
            ['jenis_kendaraan' => 'motor',  'tarif_per_jam' => 2000],
            ['jenis_kendaraan' => 'mobil',  'tarif_per_jam' => 5000],
            ['jenis_kendaraan' => 'lainnya','tarif_per_jam' => 3000],
        ];

        foreach ($tarifs as $t) {
            TbTarif::updateOrCreate(['jenis_kendaraan' => $t['jenis_kendaraan']], $t);
        }

        // Area Parkir
        $areas = [
            ['nama_area' => 'Zone A', 'kapasitas' => 50, 'terisi' => 0],
            ['nama_area' => 'Zone B', 'kapasitas' => 100, 'terisi' => 0],
            ['nama_area' => 'Zone C', 'kapasitas' => 30, 'terisi' => 0],
        ];

        foreach ($areas as $a) {
            TbAreaParkir::updateOrCreate(['nama_area' => $a['nama_area']], $a);
        }
    }
}
