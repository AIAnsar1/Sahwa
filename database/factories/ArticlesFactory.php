<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\{Authors, Category};
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Articles>
 */
class ArticlesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->unique()->word(),
            'description' => $this->faker->text(300),
            'content' => $this->faker->paragraphs(5, true),
            'views' => $this->faker->numberBetween(0, 5000),
            'thumbnail' => $this->faker->imageUrl(640, 480, 'articles', true, 'article'),
            'like' => $this->faker->numberBetween(0, 1000),
            'categories_id' => Category::factory(),
            'authors_id' => Authors::factory(),
        ];
    }
}
