<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        /**
         * ======================
         * SEEDER ADMIN
         * ======================
         */
        $admin = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin',
                'password' => bcrypt('password123'), // ganti password
            ]
        );

        if (! $admin->hasRole('admin')) {
            $admin->assignRole('admin');
        }

        /**
         * ======================
         * SEEDER USER BIASA
         * ======================
         */
        $user = User::firstOrCreate(
            ['email' => 'user@example.com'],
            [
                'name' => 'User',
                'password' => bcrypt('password123'), // ganti password
            ]
        );

        if (! $user->hasRole('user')) {
            $user->assignRole('user');
        }
    }
}
