<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Image;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'name' => 'Postre de Chocolate',
                'description' => 'Postre de Chocolate',
                'price' => 700,
                'amount' => 1,
                'type_id' => '3',
                'category_id' => '1',
            ],

            [
                'name' => 'Postre de Vainilla',
                'description' => 'Postre de Vainilla',
                'price' => 800,
                'amount' => 1,
                'type_id' => '3',
                'category_id' => '1',
            ],

            [
                'name' => 'Postre de Frutilla',
                'description' => 'Postre de Frutilla',
                'price' => 900,
                'amount' => 1,
                'type_id' => '3',
                'category_id' => '1',
            ],
            [
                'name' => 'Sandwich caliente',
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
            ],
            [
                'name' => 'milhoja',
                'description' => 'milhoja',
                'price' => 100,
                'amount' => 1,
                'type_id' => '3',
                'category_id' => '1',
            ],
            [
                'name' => 'yo-yo',
                'description' => 'yo-yo',
                'price' => 95,
                'amount' => 1,
                'type_id' => '1',
                'category_id' => '1',
            ],
            [
                'name' => 'pasta frola',
                'description' => 'pasta frola',
                'price' => 187,
                'amount' => 1,
                'type_id' => '2',
                'category_id' => '1',
            ],
            [
                'name' => 'cañon de dulce de leche',
                'description' => 'cañon de dulce de leche',
                'price' => 145,
                'amount' => 1,
                'type_id' => '1',
                'category_id' => '1',
            ],
            [
                'name' => 'sandwich olímpico de copetín',
                'description' => 'sandwich olímpico de copetín',
                'price' => 70,
                'amount' => 1,
                'type_id' => '1',
                'category_id' => '3',
            ],
            [
                'name' => 'empanada de carne',
                'description' => 'empanada de carne',
                'price' => 80,
                'amount' => 1,
                'type_id' => '1',
                'category_id' => '3',
            ],
            [
                'name' => 'empanada de pollo',
                'description' => 'empanada de pollo',
                'price' => 80,
                'amount' => 1,
                'type_id' => '1',
                'category_id' => '3',
            ],
            [
                'name' => 'empanada de jamón y queso',
                'description' => 'empanada de jamón y queso',
                'price' => 80,
                'amount' => 1,
                'type_id' => '1',
                'category_id' => '3',
            ],
            [
                'name' => 'pizza',
                'description' => 'pizza',
                'price' => 120,
                'amount' => 1,
                'type_id' => '1',
                'category_id' => '3',
            ],
            [
                'name' => 'pizza muzzarela',
                'description' => 'pizza muzzarela',
                'price' => 200,
                'amount' => 1,
                'type_id' => '1',
                'category_id' => '3',
            ],
            [
                'name' => 'pizza napolitana',
                'description' => 'pizza napolitana',
                'price' => 230,
                'amount' => 1,
                'type_id' => '1',
                'category_id' => '3',
            ],
            [
                'name' => 'pizza con panceta',
                'description' => 'pizza con panceta',
                'price' => 260,
                'amount' => 1,
                'type_id' => '1',
                'category_id' => '3',
            ],
            [
                'name' => 'hamburguesa',
                'description' => 'hamburguesa',
                'price' => 170,
                'amount' => 1,
                'type_id' => '1',
                'category_id' => '3',
            ],
            [
                'name' => 'pascualina',
                'description' => 'pascualina',
                'price' => 130,
                'amount' => 1,
                'type_id' => '1',
                'category_id' => '3',
            ],
            [
                'name' => 'Croissant de jamón y queso',
                'description' => 'Croissant de jamón y queso',
                'price' => 70,
                'amount' => 1,
                'type_id' => '1',
                'category_id' => '3',
            ],
            [
                'name' => 'Croquetas de jamón y queso',
                'description' => 'Croquetas de jamón y queso',
                'price' => 70,
                'amount' => 1,
                'type_id' => '1',
                'category_id' => '3',
            ]
        ];

        $imagenes = [
            '1' => [
                file_get_contents(public_path("img/postre_chocolate.jpg")),
                file_get_contents(public_path("img/postre_chocolate2.jpg")),
                file_get_contents(public_path("img/postre_chocolate3.jpg")),
                file_get_contents(public_path("img/postre_chocolate4.jpg")),
            ],
            '2' => [
                file_get_contents(public_path("img/postre_vainilla.jpg")),
                file_get_contents(public_path("img/postre_vainilla2.jpg")),
                file_get_contents(public_path("img/postre_vainilla3.jpg")),
            ],
            '3' => [
                file_get_contents(public_path("img/postre_frutilla.jpg")),
                file_get_contents(public_path("img/postre_frutilla2.jpg")),
                file_get_contents(public_path("img/postre_frutilla3.jpg")),
                file_get_contents(public_path("img/postre_frutilla4.jpg")),
                file_get_contents(public_path("img/postre_frutilla5.jpg"))
            ],
            '4' => [
                file_get_contents(public_path("img/Sandwich.jpg")),
                file_get_contents(public_path("img/Sandwich2.jpg")),
                file_get_contents(public_path("img/Sandwich3.jpg")),
            ],
            '5' => [
                file_get_contents(public_path("img/Coca1lt.jpg"))
            ],
            '6' => [
                file_get_contents(public_path("img/Coca2lt.jpg"))
            ],
            '7' => [
                file_get_contents(public_path("img/Fanta2lt.jpg"))
            ],
            '8' => [
                file_get_contents(public_path("img/Sprite2lt.jpg"))
            ],
            '9' => [
                file_get_contents(public_path("img/mil-hojas.jpg")),
                file_get_contents(public_path("img/mil-hojas2.jpg")),
                file_get_contents(public_path("img/mil-hojas3.jpg"))
            ],
            '10' => [
                file_get_contents(public_path("img/yo-yo.jpg")),
                file_get_contents(public_path("img/yo-yo2.jpg")),
                file_get_contents(public_path("img/yo-yo3.jpg")),
                file_get_contents(public_path("img/yo-yo4.jpg"))
            ],
            '11' => [
                file_get_contents(public_path("img/pastaFrola.jpg")),
                file_get_contents(public_path("img/pastaFrola2.jpg")),
                file_get_contents(public_path("img/pastaFrola3.jpg")),
                file_get_contents(public_path("img/pastaFrola4.jpg")),
                file_get_contents(public_path("img/pastaFrola5.jpg")),
                file_get_contents(public_path("img/pastaFrola6.jpg"))
            ],
            '12' => [
                file_get_contents(public_path("img/canon-de-dulce-de-leche.jpg")),
                file_get_contents(public_path("img/canon-de-dulce-de-leche2.jpg")),
                file_get_contents(public_path("img/canon-de-dulce-de-leche3.jpg")),
                file_get_contents(public_path("img/canon-de-dulce-de-leche4.jpg"))
            ],
            '13' => [
                file_get_contents(public_path("img/sandwich-olimpico-copetin.jpg")),
                file_get_contents(public_path("img/sandwich-olimpico-copetin2.jpg")),
                file_get_contents(public_path("img/sandwich-olimpico-copetin3.jpg")),
                file_get_contents(public_path("img/sandwich-olimpico-copetin4.jpg"))
            ],
            '14' => [
                file_get_contents(public_path("img/empanadaCarne.jpg")),
                file_get_contents(public_path("img/empanadaCarne2.jpg")),
                file_get_contents(public_path("img/empanadaCarne3.jpg")),
                file_get_contents(public_path("img/empanadaCarne4.jpg")),
                file_get_contents(public_path("img/empanadaCarne5.jpg"))
            ],
            '15' => [
                file_get_contents(public_path("img/empanadaPollo.jpg")),
                file_get_contents(public_path("img/empanadaPollo2.jpg"))
            ],
            '16' => [
                file_get_contents(public_path("img/empanadaJamonQueso.jpg")),
                file_get_contents(public_path("img/empanadaJamonQueso2.jpg")),
                file_get_contents(public_path("img/empanadaJamonQueso3.jpg"))
            ],
            '17' => [
                file_get_contents(public_path("img/pizza.jpg")),
                file_get_contents(public_path("img/pizza2.jpg")),
                file_get_contents(public_path("img/pizza3.jpg"))
            ],
            '18' => [
                file_get_contents(public_path("img/pizzaMuzzarela.jpg")),
                file_get_contents(public_path("img/pizzaMuzzarela2.jpg")),
                file_get_contents(public_path("img/pizzaMuzzarela3.jpg")),
                file_get_contents(public_path("img/pizzaMuzzarela4.jpg")),
                file_get_contents(public_path("img/pizzaMuzzarela5.jpg")),
                file_get_contents(public_path("img/pizzaMuzzarela6.jpg")),
                file_get_contents(public_path("img/pizzaMuzzarela7.jpg")),
                file_get_contents(public_path("img/pizzaMuzzarela8.jpg"))
            ],
            '19' => [
                file_get_contents(public_path("img/pizzaNapolitana.jpg")),
                file_get_contents(public_path("img/pizzaNapolitana2.jpg")),
                file_get_contents(public_path("img/pizzaNapolitana3.jpg")),
                file_get_contents(public_path("img/pizzaNapolitana4.jpg"))
            ],
            '20' => [
                file_get_contents(public_path("img/pizzaPanceta.jpg")),
                file_get_contents(public_path("img/pizzaPanceta2.jpg")),
                file_get_contents(public_path("img/pizzaPanceta3.jpg")),
                file_get_contents(public_path("img/pizzaPanceta4.jpg"))
            ],
            '21' => [
                file_get_contents(public_path("img/hamburguesa.jpg")),
                file_get_contents(public_path("img/hamburguesa2.jpg")),
                file_get_contents(public_path("img/hamburguesa3.jpg"))
            ],
            '22' => [
                file_get_contents(public_path("img/pascualina.jpg")),
                file_get_contents(public_path("img/pascualina2.jpg"))
            ],
            '23' => [
                file_get_contents(public_path("img/croissants.jpg")),
                file_get_contents(public_path("img/croissants2.jpg")),
                file_get_contents(public_path("img/croissants3.jpg")),
                file_get_contents(public_path("img/croissants4.jpg"))
            ],
            '24' => [
                file_get_contents(public_path("img/croquetas.jpg")),
                file_get_contents(public_path("img/croquetas2.jpg")),
                file_get_contents(public_path("img/croquetas3.jpg"))
            ]
        ];

        $i = 1;

        foreach ($products as $productData) {
            $producto = Product::updateOrCreate($productData);
            $imagenesProducto = $imagenes[$i];
            foreach ($imagenesProducto as $images) {
                $producto->images()->create(['base64' => base64_encode($images)]);
            }
            $i = $i + 1;
        }

        //Product::factory()->count(20)->create();
    }
}
