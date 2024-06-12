<?php

namespace Tests\Feature;

use App\Models\Client;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class ClientControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     */

    use RefreshDatabase, WithFaker;

    /** @test */
    public function it_displays_client_index_page()
    {
        $adminRole = Role::firstOrCreate(['name' => 'Admin']);
        $user = User::factory()->create();
        $user->assignRole($adminRole);
        $this->actingAs($user);
        $response = $this->get(route('clientes.index'));

        $response->assertStatus(200)
            ->assertViewIs('clients.index');
    }

    /** @test */
    public function it_displays_client_create_page()
    {
        $adminRole = Role::firstOrCreate(['name' => 'Admin']);
        $user = User::factory()->create();
        $user->assignRole($adminRole);
        $this->actingAs($user);
        $response = $this->get(route('clientes.create'));

        $response->assertStatus(200)
            ->assertViewIs('clients.create');
    }

    /** @test */
    public function it_stores_new_client()
    {
        $client = Client::factory()->create();

        $this->assertModelExists($client);
    }

    /** @test */
    // public function it_updates_client()
    // {
    //     $client = Client::factory()->create();

    //     $updatedData = [
    //         'fullname' => $this->faker->name,
    //         'address' => $this->faker->address,
    //         'phone' => $this->faker->phoneNumber,
    //         'stars' => $this->faker->numberBetween(1, 5),
    //     ]; 

    //     $response = $this->put(route('clientes.update', $client), ["fullname" => $updatedData["fullname"]]);

    //     $response->assertRedirect(route('clientes.index'));
    // }

    /** @test */
    public function it_deletes_client()
    {
        $client = Client::factory()->create();

        $client->delete();

        $this->assertModelMissing($client);
    }
}
