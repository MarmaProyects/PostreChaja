<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Image;
use App\Services\img_to_base64;

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
                'category_id' => '1',
            ],

            [
                'name' => 'Postre Vainilla',
                'description' => 'Postre Vainilla',
                'price' => 800,
                'amount' => 1,
                'type_id' => '3',
                'category_id' => '1',
            ],

            [
                'name' => 'Postre Fresa',
                'description' => 'Postre Fresa',
                'price' => 900,
                'amount' => 1,
                'type_id' => '3',
                'category_id' => '1',
            ],
            [
                'name' => 'Sandwich de jamón y queso',
                'description' => 'Sandwich de jamón y queso, con pan de sandwich',
                'price' => 40,
                'amount' => 1,
                'type_id' => '1',
                'category_id' => '3',
            ],
            [
                'name' => 'Coca cola 1LT',
                'description' => 'Coca cola de 1lt',
                'price' => 120,
                'amount' => 1,
                'type_id' => '2',
                'category_id' => '2',
            ],
            [
                'name' => 'Coca cola 2LT',
                'description' => 'Coca cola de 2lt',
                'price' => 160,
                'amount' => 1,
                'type_id' => '2',
                'category_id' => '2',
            ],
            [
                'name' => 'Fanta 2LT',
                'description' => 'Fanta de 2lt',
                'price' => 160,
                'amount' => 1,
                'type_id' => '2',
                'category_id' => '2',
            ],
            [
                'name' => 'Sprite 2LT',
                'description' => 'Sprite de 2lt',
                'price' => 140,
                'amount' => 1,
                'type_id' => '2',
                'category_id' => '2',
            ]];

            $imagenes = [
                file_get_contents(public_path("img/postre_chocolate.jpg")),
                file_get_contents(public_path("img/postre_vainilla.jpg")),
                file_get_contents(public_path("img/postre_frutilla.png")),
                file_get_contents(public_path("img/Sandwich.jpg")),
                file_get_contents(public_path("img/Coca1lt.jpg")),
                file_get_contents(public_path("img/Coca2lt.jpg")),
                file_get_contents(public_path("img/Coca3lt.jpg")),
                file_get_contents(public_path("img/Fanta2lt.jpg")),
                file_get_contents(public_path("img/Sprite2lt.jpg")),
            ];

            $i = 0;

            foreach ($products as $productData) {
                $producto = Product::updateOrCreate($productData);
                Image::updateOrCreate(['product_id' => $producto->id], ['base64' => base64_encode($imagenes[$i])]);
                $i += 1;
            }

            //Product::factory()->count(20)->create();
    }
}
