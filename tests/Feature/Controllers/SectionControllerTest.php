<?php

namespace Tests\Feature;

use App\Models\Section;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SectionControllerTest extends TestCase
{
    use RefreshDatabase;
    public function it_can_store_a_section()
    {
        $data = [
            'name' => 'Drinks'
        ];

        $response = $this->post(route('sections.store'), $data);

        $this->assertDatabaseHas('sections', $data);
    }

    /** @test */
    public function it_can_update_a_section()
    {
        $section = Section::factory()->create();

        $data = [
            'name' => 'Updated Section'
        ];

        $response = $this->put(route('sections.update', $section->id), $data);

        $this->assertDatabaseHas('sections', [
            'id' => $section->id,
            'name' => 'Updated Section'
        ]);
    }

    /** @test */
    public function it_can_destroy_a_section()
    {
        $section = Section::factory()->create();

        $response = $this->delete(route('sections.destroy', $section->id));

        $this->assertDatabaseMissing('sections', ['id' => $section->id]);
    }
}
