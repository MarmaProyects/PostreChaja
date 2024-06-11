<?php

namespace Tests\Feature;

use App\Models\Section;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class SectionControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_store_a_section()
    {
        $adminRole = Role::firstOrCreate(['name' => 'Admin']);
        $user = User::factory()->create();
        $user->assignRole($adminRole);
        $this->actingAs($user);

        $data = [
            'name' => 'Drinks'
        ];

        $response = $this->post(route('secciones.store'), $data);

        $this->assertDatabaseHas('sections', $data);
    }

    /** @test */
    public function it_can_update_a_section()
    {
        $adminRole = Role::firstOrCreate(['name' => 'Admin']);
        $user = User::factory()->create();
        $user->assignRole($adminRole);
        $this->actingAs($user);

        $section = Section::factory()->create();

        $data = [
            'name' => 'Updated Section'
        ];

        $response = $this->put(route('secciones.update', $section->id), $data);

        $this->assertDatabaseHas('sections', [
            'id' => $section->id,
            'name' => 'Updated Section'
        ]);
    }

    /** @test */
    public function it_can_destroy_a_section()
    {
        $adminRole = Role::firstOrCreate(['name' => 'Admin']);
        $user = User::factory()->create();
        $user->assignRole($adminRole);
        $this->actingAs($user);

        $section = Section::factory()->create();

        $response = $this->delete(route('secciones.destroy', $section->id));

        $this->assertDatabaseMissing('sections', ['id' => $section->id]);
    }
}
