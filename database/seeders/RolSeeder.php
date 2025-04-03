<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolSeeder extends Seeder
{
    public function run()
    {


        $permisos = [
            'ver productos', 'crear productos', 'editar productos', 'eliminar productos',
            'ver clientes', 'crear clientes', 'editar clientes', 'eliminar clientes',
            'ver pedidos', 'crear pedidos', 'editar pedidos', 'eliminar pedidos',
            'ver usuarios', 'crear usuarios', 'editar usuarios', 'eliminar usuarios',
            'ver informes',
            'ver categorías', 'crear categorías', 'editar categorías', 'eliminar categorías',
            'ver stock', 'actualizar stock', 'activar usuarios',
            'cambiar estado pedido'
        ];

        foreach ($permisos as $permiso) {
            Permission::firstOrCreate(['name' => $permiso]);
        }

        $admin = Role::firstOrCreate(['name' => 'Admin']);
        $admin->syncPermissions(Permission::all());

        $gerente = Role::firstOrCreate(['name' => 'Gerente']);
        $gerente->syncPermissions([
            'ver productos', 'crear productos', 'editar productos', 'eliminar productos',
            'ver clientes', 'crear clientes', 'editar clientes', 'eliminar clientes',
            'ver pedidos', 'crear pedidos', 'editar pedidos', 'eliminar pedidos',
            'ver categorías', 'crear categorías', 'editar categorías', 'eliminar categorías',
            'ver stock', 'actualizar stock'
        ]);

        $directivo = Role::firstOrCreate(['name' => 'Directivo']);
        $directivo->syncPermissions([
            'ver informes',
            'ver productos', 'ver clientes', 'ver pedidos', 'ver categorías', 'ver stock'
        ]);

        $administrativo = Role::firstOrCreate(['name' => 'Administrativo']);
        $administrativo->syncPermissions([
            'ver productos', 'crear productos', 'editar productos', 'eliminar productos',
            'ver clientes', 'crear clientes', 'editar clientes',
            'ver pedidos', 'crear pedidos', 'editar pedidos',
            'ver categorías', 'crear categorías', 'editar categorías', 'eliminar categorías',
            'ver usuarios',
            'ver stock'
        ]);

        $gerenteAlmacen = Role::firstOrCreate(['name' => 'Logistica']);
        $gerenteAlmacen->syncPermissions([
            'ver productos',
            'ver pedidos',
            'ver clientes',
            'ver stock',
            'actualizar stock',
            'cambiar estado pedido'
        ]);


    }
}
