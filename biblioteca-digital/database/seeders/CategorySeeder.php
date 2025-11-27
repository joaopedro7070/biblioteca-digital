<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Ficção Científica',
                'description' => 'Livros de ficção científica e futurismo'
            ],
            [
                'name' => 'Romance',
                'description' => 'Histórias de amor e relacionamentos'
            ],
            [
                'name' => 'Tecnologia',
                'description' => 'Livros sobre programação, tecnologia e inovação'
            ],
            [
                'name' => 'Biografia',
                'description' => 'Histórias de vida de pessoas notáveis'
            ],
            [
                'name' => 'Fantasia',
                'description' => 'Mundos mágicos e aventuras épicas'
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
