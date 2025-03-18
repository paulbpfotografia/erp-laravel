<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolSeeder extends Seeder
{
    public function run()
    {
        // Crear permisos
        $permisos = [
            'ver productos', 'crear productos', 'editar productos', 'eliminar productos',
            'ver clientes', 'crear clientes', 'editar clientes', 'eliminar clientes',
            'ver pedidos', 'crear pedidos', 'editar pedidos', 'eliminar pedidos',
            'ver usuarios', 'crear usuarios', 'editar usuarios', 'eliminar usuarios',
            'ver informes',
            'ver categorías', 'crear categorías', 'editar categorías', 'eliminar categorías',
            'ver stock', 'actualizar stock', 'activar usuarios'
        ];

        foreach ($permisos as $permiso) {
            Permission::firstOrCreate(['name' => $permiso]);
        }

        // Crear roles y asignar permisos
        $admin = Role::firstOrCreate(['name' => 'Admin']);
        $admin->givePermissionTo(Permission::all());

        $gerente = Role::firstOrCreate(['name' => 'Gerente']);
        $gerente->givePermissionTo([
            'ver productos', 'crear productos', 'editar productos', 'eliminar productos',
            'ver clientes', 'crear clientes', 'editar clientes', 'eliminar clientes',
            'ver pedidos', 'crear pedidos', 'editar pedidos', 'eliminar pedidos',
            'ver categorías', 'crear categorías', 'editar categorías', 'eliminar categorías',
            'ver stock', 'actualizar stock'
        ]);

        $empleado = Role::firstOrCreate(['name' => 'Empleado']);
        $empleado->givePermissionTo([
            'ver productos', 'crear productos', 'editar productos',
            'ver clientes', 'crear clientes', 'editar clientes',
            'ver pedidos', 'crear pedidos', 'editar pedidos',
            'ver categorías', 'crear categorías', 'editar categorías',
            'ver stock', 'actualizar stock'
        ]);

        $directivo = Role::firstOrCreate(['name' => 'Directivo']);
        $directivo->givePermissionTo([
            'ver informes',
            'ver productos', 'ver clientes', 'ver pedidos', 'ver categorías', 'ver stock'
        ]);
    }
}
