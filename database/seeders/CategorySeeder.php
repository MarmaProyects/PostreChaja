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
                'name' => 'Salados'
            ],
            [
                'id' => 2,
                'name' => 'Coca cola'
            ],
            [
                'id' => 3,
                'name' => 'Vinos'
            ],
            [
                'id' => 4,
                'name' => 'Alfajores'
            ],
            [
                'id' => 5,
                'name' => 'Postres'
            ]
            
        ];

        foreach ($categories as $categoryData) {
            Category::updateOrCreate($categoryData);
        }
    }
}
