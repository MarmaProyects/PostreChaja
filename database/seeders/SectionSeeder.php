<?php

namespace Database\Seeders;

use App\Models\Section;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sections = [
            [
                'name' => 'Chajá'
            ],
            [
                'name' => 'Confitería'
            ],
            [
                'name' => 'Rotisería'
            ],
            [
                'name' => 'Panadería'
            ],
            [
                'name' => 'Cafetería'
            ],
            [
                'name' => 'Catering'
            ]
        ];

        foreach ($sections as $sectionData) {
            Section::updateOrCreate($sectionData);
        }
    }
}
