<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::firstOrCreate(
            ['email' => 'test@example.com'],
            [
                'password' => bcrypt('password'), // Asegúrate de establecer una contraseña segura
            ]
        );

        $this->call(RoleSeeder::class);
        $this->call(ClientSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(SectionSeeder::class);
        $this->call(ProductSeeder::class);
    }
}
