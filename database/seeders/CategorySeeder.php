<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Jalankan database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Laporan Tugas Akhir',    // Untuk Mahasiswa
            'Laporan Kerja Praktik',  // Untuk Mahasiswa
            'Jurnal Mahasiswa',       // Untuk Mahasiswa
            'Modul Praktikum',        // Untuk Dosen
            'Jurnal Dosen',           // Untuk Dosen
        ];

        foreach ($categories as $category) {
            \App\Models\Category::firstOrCreate(['name' => $category]);
        }
    }
}
