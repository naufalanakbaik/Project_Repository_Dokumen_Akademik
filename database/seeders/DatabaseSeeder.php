<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Memanggil seeder kategori
        $this->call([
            CategorySeeder::class,
            UserSeeder::class
        ]);

        // Membuat user default untuk testing jika belum ada
        if (!\App\Models\User::where('email', 'admin@mail.com')->exists()) {
            \App\Models\User::create([
                'name' => 'Administrator',
                'email' => 'admin@mail.com',
                'password' => bcrypt('password'),
                'role' => 'admin',
            ]);
        }
    }
}
