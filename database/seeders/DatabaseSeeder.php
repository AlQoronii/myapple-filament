<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Memasukkan data langsung tanpa menggunakan factory
        DB::table('users')->insert([
            [
                'name' => 'Admin User',
                'email' => 'admin@admin.com',
                'password' => Hash::make('password123'),
                'role' => 'admin', // Pastikan kolom ini ada
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Regular User',
                'email' => 'user@user.com',
                'password' => Hash::make('password123'),
                'role' => 'user', // Kolom role
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // Memanggil seeder lain
        $this->call([
            CategoriesSeeder::class,
            ArticleSeeder::class,
        ]);
    }
}
