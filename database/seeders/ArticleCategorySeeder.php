<?php

namespace Database\Seeders;

use App\Models\ArticleCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ArticleCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ArticleCategory::create(['name' => 'Olah raga']);
        ArticleCategory::create(['name' => 'Politik']);
        ArticleCategory::create(['name' => 'Sosial']);
        ArticleCategory::create(['name' => 'Ekonomi']);
        ArticleCategory::create(['name' => 'Teknologi']);
        ArticleCategory::create(['name' => 'Hiburan']);
    }
}
