<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Buku;

class BukuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $books = [
            [
                'judul' => 'Seni Membaca Karakter',
                'penulis' => 'James Smith',
                'penerbit' => 'Pustaka Utama',
                'tahun' => '2022',
                'kategori' => 'Pengembangan Diri',
                'status' => 'tersedia',
                'cover' => 'cover1.jpg',
            ],
            [
                'judul' => 'Sejarah Indonesia Modern',
                'penulis' => 'Linda Hasan',
                'penerbit' => 'Gramedia',
                'tahun' => '2018',
                'kategori' => 'Sejarah',
                'status' => 'tersedia',
                'cover' => 'cover2.jpg',
            ],
            [
                'judul' => 'Pemrograman Laravel untuk Pemula',
                'penulis' => 'Andi Wijaya',
                'penerbit' => 'Informatika',
                'tahun' => '2024',
                'kategori' => 'Teknologi',
                'status' => 'tersedia',
                'cover' => 'cover3.jpg',
            ],
        ];

        foreach ($books as $data) {
            Buku::updateOrCreate(
                ['judul' => $data['judul']],
                [
                    'judul' => $data['judul'],
                    'penulis' => $data['penulis'],
                    'penerbit' => $data['penerbit'],
                    'tahun' => $data['tahun'],
                    'kategori' => $data['kategori'],
                    'status' => $data['status'],
                    'cover' => $data['cover'],
                    'available' => $data['status'] === 'tersedia' ? 1 : 0,
                ]
            );
        }
    }
}
