<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'name' => 'Postre Chocolate',
                'description' => 'Postre Chocolate',
                'price' => 700,
                'amount' => 1,
                'type_id' => '3',
                'category_id' => '1'
                //'image' => 'postre-chaja.jpg'
            ],

            [
                'name' => 'Postre Vainilla',
                'description' => 'Postre Vainilla',
                'price' => 800,
                'amount' => 1,
                'type_id' => '3',
                'category_id' => '1'
                //'image' => 'postre-chaja.jpg'
            ],

            [
                'name' => 'Postre Fresa',
                'description' => 'Postre Fresa',
                'price' => 900,
                'amount' => 1,
                'type_id' => '3',
                'category_id' => '1'
                //'image' => 'postre-chaja.jpg'
            ],
            [
                'name' => 'Sandwich de jamón y queso',
                'description' => 'Sandwich de jamón y queso, con pan de sandwich',
                'price' => 40,
                'amount' => 1,
                'type_id' => '1',
                'category_id' => '3'
                //'image' => 'Sandwich-jamon-queso.jpg'
            ],
            [
                'name' => 'Coca cola 1LT',
                'description' => 'Coca cola de 1lt',
                'price' => 120,
                'amount' => 1,
                'type_id' => '2',
                'category_id' => '2'
                //'image' => 'Coca-cola-1lt.jpg'
            ],
            [
                'name' => 'Coca cola 2LT',
                'description' => 'Coca cola de 2lt',
                'price' => 160,
                'amount' => 1,
                'type_id' => '2',
                'category_id' => '2'
                //'image' => 'Coca-cola-2lt.jpg'
            ],
            [
                'name' => 'Fanta 2LT',
                'description' => 'Fanta de 2lt',
                'price' => 160,
                'amount' => 1,
                'type_id' => '2',
                'category_id' => '2'
                //'image' => 'Fanta-2lt.jpg'
            ],
            [
                'name' => 'Sprite 2LT',
                'description' => 'Sprite de 2lt',
                'price' => 140,
                'amount' => 1,
                'type_id' => '2',
                'category_id' => '2'
                //'image' => 'Sprite-2lt.jpg'
            ]];

            foreach ($products as $productData) {
                Product::updateOrCreate($productData);
            }

            //Product::factory()->count(20)->create();
    }
}
