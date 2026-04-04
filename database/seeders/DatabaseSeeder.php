<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\KategoriAlat;
use App\Models\Alat;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Users
        User::create(['name' => 'Admin Utama', 'email' => 'admin@app.com', 'password' => 'password', 'role' => 'admin', 'is_active' => true]);
        User::create(['name' => 'Petugas Satu', 'email' => 'petugas@app.com', 'password' => 'password', 'role' => 'petugas', 'is_active' => true]);
        User::create(['name' => 'Budi Santoso', 'email' => 'budi@app.com', 'password' => 'password', 'role' => 'peminjam', 'is_active' => true]);
        User::create(['name' => 'Siti Aminah', 'email' => 'siti@app.com', 'password' => 'password', 'role' => 'peminjam', 'is_active' => true]);

        // Kategori
        $elektrik = KategoriAlat::create(['nama_kategori' => 'Elektrik', 'deskripsi' => 'Peralatan berbasis listrik']);
        $manual   = KategoriAlat::create(['nama_kategori' => 'Manual', 'deskripsi' => 'Peralatan tangan manual']);
        $ukur     = KategoriAlat::create(['nama_kategori' => 'Alat Ukur', 'deskripsi' => 'Peralatan pengukuran']);
        $berat    = KategoriAlat::create(['nama_kategori' => 'Alat Berat', 'deskripsi' => 'Peralatan berat industri']);

        // Alat dengan foto dari Unsplash (photo ID spesifik, gratis & stabil)
        $alats = [
            [
                'kategori_id' => $elektrik->id,
                'nama_alat'   => 'Bor Tangan Bosch GSR 120-LI',
                'kode_alat'   => 'T-EL-001',
                'stok_total'  => 12,
                'kondisi'     => 'baik',
                'foto'        => 'https://images.unsplash.com/photo-1504148455328-c376907d081c?w=400&h=300&fit=crop',
            ],
            [
                'kategori_id' => $elektrik->id,
                'nama_alat'   => 'Gerinda Tangan Makita 9523NB',
                'kode_alat'   => 'T-EL-002',
                'stok_total'  => 8,
                'kondisi'     => 'baik',
                'foto'        => 'https://images.unsplash.com/photo-1572981779307-38b8cabb2407?w=400&h=300&fit=crop',
            ],
            [
                'kategori_id' => $manual->id,
                'nama_alat'   => 'Kunci Inggris Krisbow 12"',
                'kode_alat'   => 'T-MA-042',
                'stok_total'  => 24,
                'kondisi'     => 'baik',
                'foto'        => 'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=400&h=300&fit=crop',
            ],
            [
                'kategori_id' => $manual->id,
                'nama_alat'   => 'Obeng Set Stanley 6 pcs',
                'kode_alat'   => 'T-MA-010',
                'stok_total'  => 20,
                'kondisi'     => 'baik',
                'foto'        => 'https://images.unsplash.com/photo-1581147036324-c47a03a81d48?w=400&h=300&fit=crop',
            ],
            [
                'kategori_id' => $ukur->id,
                'nama_alat'   => 'Vernier Caliper Digital 150mm',
                'kode_alat'   => 'T-UK-001',
                'stok_total'  => 10,
                'kondisi'     => 'baik',
                'foto'        => 'https://images.unsplash.com/photo-1609205807107-2b688f6e6e3e?w=400&h=300&fit=crop',
            ],
            [
                'kategori_id' => $ukur->id,
                'nama_alat'   => 'Laser Level 360°',
                'kode_alat'   => 'T-UK-002',
                'stok_total'  => 5,
                'kondisi'     => 'baik',
                'foto'        => 'https://images.unsplash.com/photo-1504307651254-35680f356dfd?w=400&h=300&fit=crop',
            ],
            [
                'kategori_id' => $berat->id,
                'nama_alat'   => 'Jack Hammer Hitachi H65SB3',
                'kode_alat'   => 'T-BE-009',
                'stok_total'  => 3,
                'kondisi'     => 'rusak ringan',
                'foto'        => 'https://images.unsplash.com/photo-1590959651373-a3db0f38a961?w=400&h=300&fit=crop',
            ],
            [
                'kategori_id' => $elektrik->id,
                'nama_alat'   => 'Air Compressor Elite 50L',
                'kode_alat'   => 'T-EL-010',
                'stok_total'  => 4,
                'kondisi'     => 'baik',
                'foto'        => 'https://images.unsplash.com/photo-1621905251189-08b45d6a269e?w=400&h=300&fit=crop',
            ],
        ];

        foreach ($alats as $alat) {
            Alat::create(array_merge($alat, ['stok_tersedia' => $alat['stok_total']]));
        }
    }
}
