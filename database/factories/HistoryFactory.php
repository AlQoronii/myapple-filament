<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User; // Import model User
use App\Models\Category; // Import model Category

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\History>
 */
class HistoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'scan_date' => $this->faker->dateTimeBetween('-1 year', 'now'), // Tanggal antara tahun lalu dan sekarang
            'user_id' => User::factory(), // Relasi dengan User menggunakan factory
            'scan_image_path' => $this->faker->imageUrl(640, 480, true, 'scan'), // URL dummy untuk gambar
            'disease_info_id' => Category::factory(), // Relasi dengan Category menggunakan factory
        ];
    }
}
