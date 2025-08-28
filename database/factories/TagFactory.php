<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Tag;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tag>
 */
class TagFactory extends Factory
{
    protected $model = Tag::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->unique()->word(),
        ];
    }

    public function configure(): static
    {
        return $this->afterCreating(function (Tag $tag) 
        {
            if (!app()->runningUnitTests()) 
            {
                $tags = ['Laravel', 'PHP', 'Development', 'Testing', 'Database'];
                $randomTags = $this->faker->randomElements($tags, $this->faker->numberBetween(1, 3));
                $tag->attachTags($randomTags);
            }
        });
    }
}
