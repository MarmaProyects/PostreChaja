<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Section;
use App\Models\Type;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;
use Tests\TestCase;


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
        $adminRole = Role::firstOrCreate(['name' => 'Admin']);
        $user = User::factory()->create();
        $user->assignRole($adminRole);
        $this->actingAs($user);

        $sections = Section::factory()->count(3)->create();
        $categories = Category::factory()->count(3)->create();

        $response = $this->get(route('productos.create'));

        $response->assertStatus(200);
        $response->assertViewIs('products.create');

        $response->assertViewHas('sections', function ($viewSections) use ($sections) {
            return $viewSections->count() === $sections->count() &&
                $viewSections->pluck('id')->sort()->values()->all() === $sections->pluck('id')->sort()->values()->all();
        });

        $response->assertViewHas('categories', function ($viewCategories) use ($categories) {
            return $viewCategories->count() === $categories->count() &&
                $viewCategories->pluck('id')->sort()->values()->all() === $categories->pluck('id')->sort()->values()->all();
        });
    }

    public function test_non_admin_cannot_access_create_product_page()
    {
        $user = User::factory()->create();
 
        $this->actingAs($user);
 
        $response = $this->get(route('productos.create'));
 
        $response->assertStatus(302);
        $response->assertRedirect('/');  
    }
}
