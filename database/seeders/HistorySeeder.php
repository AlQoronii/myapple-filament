<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\History;

class HistorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Generate 10 dummy histories
        History::factory()->count(10)->create([
            'user_id' => fn () => fake()->randomElement([1, 2]), // Pilih user_id antara 1-3
            'disease_info_id' => fn () => fake()->randomElement([1, 2, 3]), // Pilih disease_info_id antara 1-3
        ]);
    }
}
