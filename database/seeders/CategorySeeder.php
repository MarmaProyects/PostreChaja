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
                'name' => 'Salados'
            ],
            [
                'name' => 'Coca cola'
            ],
            [
                'name' => 'Vinos'
            ],
            [
                'name' => 'Alfajores'
            ],
            [
                'name' => 'Postres'
            ]
            
        ];

        foreach ($categories as $categoryData) {
            Category::updateOrCreate($categoryData);
        }
    }
}
