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
                'description' => 'Delicioso postre de chocolate con una combinación perfecta de sabores.',
                'price' => 700,
                'amount' => 1,
                'section_id' => '2',
                'category_id' => '5',
                'visits' => '82',
            ],
            [
                'name' => 'Postre de Vainilla',
                'description' => 'Suave y cremoso postre de vainilla, ideal para satisfacer tu antojo de algo dulce.',
                'price' => 800,
                'amount' => 1,
                'section_id' => '2',
                'category_id' => '5',
                'visits' => '182',
            ],
            [
                'name' => 'Postre de Frutilla',
                'description' => 'Refrescante postre de frutilla con una mezcla irresistible de dulzura y acidez.',
                'price' => 900,
                'amount' => 1,
                'section_id' => '2',
                'category_id' => '5',
                'visits' => '34',
            ],
            [
                'name' => 'Sandwich caliente',
                'description' => 'Sandwich caliente con jamón y queso, perfecto para una comida rápida y deliciosa.',
                'price' => 40,
                'amount' => 1,
                'section_id' => '3',
                'category_id' => '1',
                'visits' => '83',
            ],
            [
                'name' => 'Coca cola 1LT',
                'description' => 'Refrescante bebida de cola en una botella de 1 litro, perfecta para acompañar tus comidas.',
                'price' => 120,
                'amount' => 1,
                'section_id' => '2',
                'category_id' => '2',
                'visits' => '92',
            ],
            [
                'name' => 'Coca cola 2LT',
                'description' => 'Refrescante Coca Cola en una botella de 2 litros, perfecta para compartir en cualquier ocasión.',
                'price' => 160,
                'amount' => 1,
                'section_id' => '2',
                'category_id' => '2',
                'visits' => '126',
            ],
            [
                'name' => 'Fanta 2LT',
                'description' => 'Deliciosa Fanta en una botella de 2 litros, con su característico sabor afrutado y refrescante.',
                'price' => 160,
                'amount' => 1,
                'section_id' => '2',
                'category_id' => '2',
                'visits' => '287',
            ],
            [
                'name' => 'Sprite 2LT',
                'description' => 'Refrescante Sprite en una botella de 2 litros, con su sabor cítrico y burbujeante.',
                'price' => 140,
                'amount' => 1,
                'section_id' => '2',
                'category_id' => '2',
                'visits' => '182',
            ],
            [
                'name' => 'Milhoja',
                'description' => 'Deliciosa milhoja con capas crujientes y relleno de crema, perfecta para disfrutar en cualquier momento del día.',
                'price' => 100,
                'amount' => 1,
                'section_id' => '2',
                'category_id' => '5',
                'visits' => '29',
            ],
            [
                'name' => 'Yo-yo',
                'description' => 'Deliciosos dulces de caramelo en forma de yo-yo, perfectos para disfrutar en cualquier momento.',
                'price' => 95,
                'amount' => 1,
                'section_id' => '5',
                'category_id' => '4',
                'visits' => '46',
            ],
            [
                'name' => 'Pasta frola',
                'description' => 'Exquisita pasta frola casera con dulce de membrillo, ideal para acompañar el mate o el café.',
                'price' => 187,
                'amount' => 1,
                'section_id' => '5',
                'category_id' => '5',
                'visits' => '97',
            ],
            [
                'name' => 'Cañon de dulce de leche',
                'description' => 'Irresistibles cañones de masa hojaldrada rellenos de dulce de leche, una delicia para los amantes del dulce.',
                'price' => 145,
                'amount' => 1,
                'section_id' => '5',
                'category_id' => '5',
                'visits' => '193',
            ],
            [
                'name' => 'sandwich olímpico de copetín',
                'description' => 'Sabroso sandwich de copetín con una variedad de fiambres y quesos, perfecto para cualquier ocasión.',
                'price' => 70,
                'amount' => 1,
                'section_id' => '5',
                'category_id' => '1',
                'visits' => '198',
            ],
            [
                'name' => 'Empanada de carne',
                'description' => 'Deliciosas empanadas caseras rellenas de jugosa carne y condimentadas al punto justo.',
                'price' => 80,
                'amount' => 1,
                'section_id' => '5',
                'category_id' => '1',
                'visits' => '218',
            ],
            [
                'name' => 'Empanada de pollo',
                'description' => 'Exquisitas empanadas caseras rellenas de tierno pollo desmenuzado y condimentadas con especias.',
                'price' => 80,
                'amount' => 1,
                'section_id' => '5',
                'category_id' => '1',
                'visits' => '311',
            ],
            [
                'name' => 'Empanada de jamón y queso',
                'description' => 'Deliciosas empanadas caseras rellenas de jamón y queso derretido, una combinación clásica que nunca falla.',
                'price' => 80,
                'amount' => 1,
                'section_id' => '5',
                'category_id' => '1',
                'visits' => '265',
            ],
            [
                'name' => 'Pizza',
                'description' => 'Pizza artesanal con una masa crujiente y toppings frescos, una delicia que nunca pasa de moda.',
                'price' => 120,
                'amount' => 1,
                'section_id' => '3',
                'category_id' => '1',
                'visits' => '38',
            ],
            [
                'name' => 'Pizza muzzarela',
                'description' => 'Pizza con una generosa capa de queso muzzarella fundido, perfecta para los amantes del queso.',
                'price' => 200,
                'amount' => 1,
                'section_id' => '3',
                'category_id' => '1',
                'visits' => '45',
            ],
            [
                'name' => 'Pizza napolitana',
                'description' => 'Pizza con salsa de tomate, ajo, aceitunas y anchoas, un clásico de la cocina italiana con un toque de sabor mediterráneo.',
                'price' => 230,
                'amount' => 1,
                'section_id' => '3',
                'category_id' => '1',
                'visits' => '75',
            ],
            [
                'name' => 'Pizza con panceta',
                'description' => 'Pizza con panceta crujiente y cebolla caramelizada, una combinación irresistible de sabores.',
                'price' => 260,
                'amount' => 1,
                'section_id' => '3',
                'category_id' => '1',
                'visits' => '28',
            ],
            [
                'name' => 'Hamburguesa',
                'description' => 'Hamburguesa casera con carne jugosa, lechuga, tomate y queso, todo en un pan suave y esponjoso.',
                'price' => 170,
                'amount' => 1,
                'section_id' => '3',
                'category_id' => '1',
                'visits' => '72',
            ],
            [
                'name' => 'Pascualina',
                'description' => 'Pascualina casera con masa hojaldrada, rellena de espinacas, huevo duro y queso, horneada hasta dorarse.',
                'price' => 130,
                'amount' => 1,
                'section_id' => '3',
                'category_id' => '1',
                'visits' => '243',
            ],
            [
                'name' => 'Croissant de jamón y queso',
                'description' => 'Croissant de hojaldre relleno de jamón y queso fundido, una delicia para disfrutar en cualquier momento del día.',
                'price' => 70,
                'amount' => 1,
                'section_id' => '3',
                'category_id' => '1',
                'visits' => '142',
            ],
            [
                'name' => 'Croquetas de jamón y queso',
                'description' => 'Croquetas caseras de jamón y queso, crujientes por fuera y suaves por dentro, un bocado irresistible.',
                'price' => 70,
                'amount' => 1,
                'section_id' => '3',
                'category_id' => '1',
                'visits' => '134',
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
