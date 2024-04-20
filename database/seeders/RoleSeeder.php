<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = Role::create(['name' => 'Admin']);
        $funcionario = Role::create(['name' => 'Funcionario']);
        $cliente = Role::create(['name' => 'Cliente']);
        $guest = Role::create(['name' => 'Guest']);
    }
}
