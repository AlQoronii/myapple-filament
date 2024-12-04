<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'Admin 1',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('123456789'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'User 1',
                'email' => 'user@gmail.com',
                'password' => Hash::make('123456789'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
