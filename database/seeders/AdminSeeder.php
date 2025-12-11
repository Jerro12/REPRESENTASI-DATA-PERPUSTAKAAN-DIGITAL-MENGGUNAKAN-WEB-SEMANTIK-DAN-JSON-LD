<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        // Cari user admin berdasarkan email
        $admin = User::firstOrCreate(
            ['email' => 'admin@example.com'], // kondisi unik
            [
                'name' => 'Admin',
                'password' => bcrypt('password123'), // ganti dengan password kamu
            ]
        );

        // Assign role admin (aman, tidak duplikat)
        if (! $admin->hasRole('admin')) {
            $admin->assignRole('admin');
        }
    }
}
