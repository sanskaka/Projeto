<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::updateOrCreate(['name' => 'users.list'], ['display_name' => 'Administração - Listar usuários']);
        Permission::updateOrCreate(['name' => 'users.view'], ['display_name' => 'Administração - Visualizar usuários']);
        Permission::updateOrCreate(['name' => 'users.create'], ['display_name' => 'Administração - Criar usuários']);
        Permission::updateOrCreate(['name' => 'users.edit'], ['display_name' => 'Administração - Editar usuários']);
        Permission::updateOrCreate(['name' => 'users.delete'], ['display_name' => 'Administração - Excluir usuários']);
        Permission::updateOrCreate(['name' => 'users.destroy'], ['display_name' => 'Administração - Destruir usuários']);
        Permission::updateOrCreate(['name' => 'users.restore'], ['display_name' => 'Administração - Restaurar usuários']);
    }
}
