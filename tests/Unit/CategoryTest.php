<?php
namespace Tests\Unit;

use App\Models\Category;
use App\Models\Product;
use App\Models\Section;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_category_can_be_created()
    {
        $category = Category::create([
            'name' => 'Bakery'
        ]);

        $this->assertDatabaseHas('categories', [
            'name' => 'Bakery',
        ]);
    }

    /** @test */
    public function a_category_has_many_products()
    {
        $category = Category::factory()->create([
            'name' => 'Groceries'
        ]);

        $section = Section::factory()->create([
            'name' => 'Drinks'
        ]);

        $product1 = Product::factory()->create([
            'category_id' => $category->id,
            'section_id' => $section->id,
        ]);

        $product2 = Product::factory()->create([
            'category_id' => $category->id,
            'section_id' => $section->id,
        ]);

        $this->assertTrue($category->products->contains($product1));
        $this->assertTrue($category->products->contains($product2));
    }
}
