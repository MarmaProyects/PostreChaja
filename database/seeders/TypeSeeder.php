<?php

namespace Database\Seeders;

use App\Models\Type;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = [
            [
                'id' => 1,
                'name' => 'individual'
            ],
            [
                'id' => 2,
                'name' => 'varios'
            ],
            [
                'id' => 3,
                'name' => 'familiar'
            ]
        ];

        foreach ($types as $typeData) {
            Type::updateOrCreate($typeData);
        }
    }
}
