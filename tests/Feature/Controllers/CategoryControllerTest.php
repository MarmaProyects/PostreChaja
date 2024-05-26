<?php

namespace Tests\Feature;

use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CategoryControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_store_a_category()
    {
        $data = [
            'name' => 'Beverages'
        ];

        $response = $this->post(route('category.store'), $data);

        $this->assertDatabaseHas('categories', $data);
    }

    /** @test */
    public function it_can_update_a_category()
    {
        $category = Category::factory()->create();

        $data = [
            'name' => 'Updated Category'
        ];

        $response = $this->put(route('category.update', $category->id), $data);

        $this->assertDatabaseHas('categories', [
            'id' => $category->id,
            'name' => 'Updated Category'
        ]);
    }

    /** @test */
    public function it_can_destroy_a_category()
    {
        $category = Category::factory()->create();

        $response = $this->delete(route('category.destroy', $category->id));

        $this->assertDatabaseMissing('categories', ['id' => $category->id]);
    }
}
