<?php

// ====================================================================
// database/seeders/MahasiswaSeeder.php
// Seed data contoh untuk tabel mahasiswas (dipakai di halaman /about).
// Jalankan lewat: php artisan db:seed
// ====================================================================

namespace Database\Seeders;

use App\Models\Mahasiswa;
use Illuminate\Database\Seeder;

class MahasiswaSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'nama'   => 'Yobel Hizkia Sijabat',
                'email'  => 'yobelhizkia.4253550004@mhs.unimed.ac.id',
                'github' => 'Hizkia-el',
            ],
        ];

        foreach ($data as $row) {
            Mahasiswa::updateOrCreate(['nama' => $row['nama']], $row);
        }
    }
}
