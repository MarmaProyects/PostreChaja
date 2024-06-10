<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class CategoryControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_store_a_category()
    {
        $adminRole = Role::firstOrCreate(['name' => 'Admin']);
        $user = User::factory()->create();
        $user->assignRole($adminRole);
        $this->actingAs($user);

        $data = [
            'name' => 'Beverages'
        ];

        $response = $this->post(route('categorias.store'), $data);

        $this->assertDatabaseHas('categories', $data);
    }

    /** @test */
    public function it_can_update_a_category()
    {
        $adminRole = Role::firstOrCreate(['name' => 'Admin']);
        $user = User::factory()->create();
        $user->assignRole($adminRole);
        $this->actingAs($user);

        $category = Category::factory()->create();

        $data = [
            'name' => 'Updated Category'
        ];

        $response = $this->put(route('categorias.update', $category->id), $data);

        $this->assertDatabaseHas('categories', [
            'id' => $category->id,
            'name' => 'Updated Category'
        ]);
    }

    /** @test */
    public function it_can_destroy_a_category()
    {
        $adminRole = Role::firstOrCreate(['name' => 'Admin']);
        $user = User::factory()->create();
        $user->assignRole($adminRole);
        $this->actingAs($user);

        $category = Category::factory()->create();

        $response = $this->delete(route('categorias.destroy', $category->id));

        $this->assertDatabaseMissing('categories', ['id' => $category->id]);
    }
}
