<?php

namespace Database\Seeders;

use App\Models\User;
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
        $admin = Role::updateOrCreate(['name' => 'Admin']);
        $funcionario = Role::updateOrCreate(['name' => 'Funcionario']);
        $cliente = Role::updateOrCreate(['name' => 'Cliente']);
        $guest = Role::updateOrCreate(['name' => 'Guest']);
    }
}
