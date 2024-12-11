<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // add title, content, image_path, source, and publication_date
            'title' => $this->faker->sentence(),
            'content' => $this->faker->paragraph(),
            'image_path' => $this->faker->imageUrl(),
            'source' => $this->faker->url(),
            'publication_date' => $this->faker->date(),
            
        ];
    }
}
