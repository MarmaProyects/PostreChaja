<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'id' => 1,
                'name' => 'Postres'
            ],
            [
                'id' => 2,
                'name' => 'Bebidas'
            ],
            [
                'id' => 3,
                'name' => 'Comidas'
            ]
        ];

        foreach ($categories as $categoryData) {
            Category::updateOrCreate($categoryData);
        }
    }
}
