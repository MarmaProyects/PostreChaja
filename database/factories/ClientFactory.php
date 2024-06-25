<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Client>
 */
class ClientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    public function definition(): array
    {
        $user = User::firstOrCreate(
            ['email' => $this->faker->email],
            [
                'password' => bcrypt('password'),
            ]
        );
        $user->assignRole('Cliente');
        return [
            'user_id' => $user->id,
            'fullname' => $this->faker->name,
            'address' => $this->faker->address,
            'phone' => $this->faker->phoneNumber,
            'total_stars' =>  $this->faker->numberBetween(1, 5),
            'available_stars' =>  $this->faker->numberBetween(1, 5),
            'notifications' => $this->faker->boolean,
        ];
    }
}
