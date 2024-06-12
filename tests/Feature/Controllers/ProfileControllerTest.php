<?php

namespace Tests\Feature;

use App\Models\Client;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class ProfileControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function profile_page_is_displayed(): void
    {
        $user = User::factory()->create();
        $client = Client::factory()->create(['user_id' => $user->id]);

        $response = $this->actingAs($user)->get('/perfil');

        $response->assertOk();
        $response->assertViewIs('profile.edit');
        $response->assertViewHas('client', $client);
    }

    /**
     * @test
     */
    // public function profile_information_can_be_updated(): void
    // {
    //     $user = User::factory()->create();
    //     $client = Client::factory()->create(['user_id' => $user->id]);

    //     $response = $this->actingAs($user)->patch('/perfil', [
    //         'fullname' => 'Updated Name',
    //         'email' => 'updated@example.com',
    //         'phone' => '1234567890',
    //         'address' => '123 Updated St',
    //         '_token' => csrf_token(),
    //     ]);

    //     $response->assertSessionHasNoErrors();
    //     $response->assertRedirect(route('perfil.edit'));

    //     $user->refresh();
    //     $client->refresh();

    //     $this->assertSame('updated@example.com', $user->email);
    //     $this->assertSame('Updated Name', $client->fullname);
    //     $this->assertSame('1234567890', $client->phone);
    //     $this->assertSame('123 Updated St', $client->address);
    // }

    /**
     * @test
     */
    public function user_can_delete_their_account(): void
    {
        $user = User::factory()->create();
        $client = Client::factory()->create(['user_id' => $user->id]);

        $response = $this->actingAs($user)->delete('/perfil', [
            'password' => 'password',
            '_token' => csrf_token(),
        ]);

        $response->assertSessionHasNoErrors();
        $response->assertRedirect('/');

        $this->assertGuest();
        $this->assertNull(User::find($user->id));
        $this->assertNull(Client::find($client->id));
    }

    /**
     * @test
     */
    public function correct_password_must_be_provided_to_delete_account(): void
    {
        $user = User::factory()->create([
            'password' => Hash::make('password')
        ]);
        $client = Client::factory()->create(['user_id' => $user->id]);

        $response = $this->actingAs($user)->from('/perfil')->delete('/perfil', [
            'password' => 'wrong-password',
            '_token' => csrf_token(),
        ]);

        $response->assertSessionHasErrorsIn('userDeletion', 'password');
        $response->assertRedirect('/perfil');

        $this->assertNotNull(User::find($user->id));
        $this->assertNotNull(Client::find($client->id));
    }
}
