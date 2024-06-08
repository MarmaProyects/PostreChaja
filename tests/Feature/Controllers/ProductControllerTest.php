<?php
namespace Tests\Feature;

use App\Models\Category;
use App\Models\Type;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Database\Factories\ProductFactory;


class ProductControllerTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_index_returns_view(): void
    {
        $response = $this->get(route('products.index'));
        $response->assertViewIs('products.index');
        $response->assertStatus(200); // O el código de estado correcto
    }

    public function test_create_returns_view(): void
    {
        $response = $this->get(route('productos.create'));
        $response->assertViewIs('products.create');
        $response->assertStatus(200); // O el código de estado correcto
    }

    // public function test_store_creates_product_and_redirects(): void
    // {
    //     $type = Type::create (['name' => 'Postre']);
    //     $category = Category::create(['name' => 'confiteria']);
    //     $data = [
    //         'name' => 'Test Product',
    //         'price' => 10.99,
    //         'description' => 'Test Description',
    //         'amount' => 5,
    //         'type_id' => $type->id,
    //         'category_id' => $category->id,
    //     ];
        
    //     $response = $this->post(route('productos.store'), $data);
    //     //$response->assertRedirect(route('productos.index'));

    //     // Verificar que el producto se ha creado correctamente en la base de datos
    //     $this->assertDatabaseHas('products', $data);
    // }

    // public function test_edit_returns_view(): void
    // {
    //     // Utiliza la clase ProductFactory para crear una instancia de Producto
    //     $product = ProductFactory::new()->create(); // Aquí es donde creas una instancia de producto con la nueva ProductFactory

    //     $response = $this->get(route('productos.edit', $product));
    //     $response->assertViewIs('products.edit');
    //     $response->assertStatus(200); // O el código de estado correcto
    // }

    // public function test_update_updates_product_and_redirects(): void
    // {
    //     $product = ProductFactory::new()->create();

    //     $data = [
    //         'name' => 'Updated Product Name',
    //         'price' => 20.99,
    //         'description' => 'Updated Description',
    //         'amount' => 10,
    //         'type_id' => 1,
    //         'category_id' => 1,
    //     ];

    //     $response = $this->put(route('productos.update', $product), $data);
    //     $response->assertRedirect(route('products.index'));

    //     // Verificar que el producto se ha actualizado correctamente en la base de datos
    //     $this->assertDatabaseHas('products', $data);
    // }
}
