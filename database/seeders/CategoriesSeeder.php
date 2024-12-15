<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $categories = [
            [
                'category' => 'scab',
                'symptoms' => 'Bercak-bercak gelap dan kasar pada daun dan buah.',
                'description' => 'Scab adalah penyakit jamur yang menyebabkan bercak-bercak gelap dan kasar pada daun dan buah.',
                'treatment' => 'Buang daun dan buah yang terkena, aplikasikan fungisida, dan pangkas pohon untuk sirkulasi udara yang lebih baik.'
            ],
            [
                'category' => 'rust',
                'symptoms' => 'Bercak-bercak oranye pada daun dan dapat mengurangi hasil buah.',
                'description' => 'Rust adalah infeksi jamur yang menyebabkan bercak-bercak oranye pada daun dan dapat mengurangi hasil buah.',
                'treatment' => 'Buang daun yang terinfeksi, aplikasikan fungisida berbasis sulfur, dan pastikan pohon memiliki sirkulasi udara yang baik.'
            ],
            [
                'category' => 'healthy',
                'symptoms' => 'Tidak ada tanda-tanda penyakit',
                'description' => 'Tanaman tidak menunjukkan tanda-tanda penyakit dan berada dalam kondisi optimal.',
                'treatment' => 'Tidak ada tindakan yang perlu dilakukan.'
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
