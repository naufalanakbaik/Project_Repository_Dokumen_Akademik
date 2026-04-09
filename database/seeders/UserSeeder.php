<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;


class UserSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            [
                'name' => 'Admin',
                'email' => 'admin@admin.com',
                'password' => 'admin123',
                'role' => 'admin'
            ],
            [
                'name' => 'Mahasiswa',
                'email' => 'mahasiswa@gmail.com',
                'password' => 'mahasiswa123',
                'role' => 'mahasiswa'
            ],
            [
                'name' => 'Dosen',
                'email' => 'dosen@gmail.com',
                'password' => 'dosen123',
                'role' => 'dosen'
            ],
            [
                'name' => 'Kaprodi',
                'email' => 'kaprodi@gmail.com',
                'password' => 'kaprodi123',
                'role' => 'kaprodi'
            ],
        ];

        foreach ($users as $user) {
            User::updateOrCreate(
                ['email' => $user['email']], // kondisi unik
                [
                    'name' => $user['name'],
                    'password' => Hash::make($user['password']),
                    'role' => $user['role'],
                ]
            );
        }
    }
}