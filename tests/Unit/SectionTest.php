<?php

namespace Tests\Unit;

use App\Models\Category;
use App\Models\Section;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SectionTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_section_can_be_created()
    {
        $section = Section::create([
            'name' => 'Desserts'
        ]);

        $this->assertDatabaseHas('sections', [
            'name' => 'Desserts',
        ]);
    }

    /** @test */
    public function a_section_has_many_products()
    {
        $section = Section::factory()->create([
            'name' => 'Drinks'
        ]);

        $category = Category::factory()->create([
            'name' => 'Rotiseria'
        ]);

        $product1 = Product::factory()->create([ 
            'section_id' => $section->id,
            'category_id' => $category->id, 
        ]);

        $product2 = Product::factory()->create([ 
            'section_id' => $section->id,
            'category_id' => $category->id,  
        ]);

        $this->assertTrue($section->products->contains($product1));
        $this->assertTrue($section->products->contains($product2));
    }
}
