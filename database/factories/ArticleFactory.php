<?php

namespace Database\Factories;

use App\Models\Article;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Article>
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
            'title' => $this->faker->sentence(3),
            'content' => $this->faker->paragraph(5),
            'slug' => $this->faker->slug(),
            'article_category_id' => \App\Models\ArticleCategory::inRandomOrder()->first()->id
        ];
    }

    public function longerContent($count = 10): static
    {
        return $this->state(fn () => [
            'content' => $this->faker->paragraph($count),
        ]);
    }

    public function slugFromTitle(): static
    {
        return $this->state(fn ($attributes) => [
            'slug' => Str::slug($attributes['title']),
        ]);
    }
}
