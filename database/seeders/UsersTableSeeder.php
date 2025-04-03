<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Spatie\Permission\Models\Role;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Usuario Admin
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('12345678'),
            'image' => 'imagenes_usuarios/admin_imagen.jpg'
        ]);
        $admin->assignRole('Admin');

        // Usuario Administrativo activo
        $administrativo1 = User::create([
            'name' => 'Administrativo1',
            'email' => 'administrativo1@empresa.com',
            'password' => Hash::make('12345678'),
            'image' => 'imagenes_usuarios/empleado_imagen.webp',
            'active' => 1
        ]);
        $administrativo1->assignRole('Administrativo');

        // Usuario Administrativo inactivo
        $administrativo2 = User::create([
            'name' => 'Administrativo2',
            'email' => 'administrativo2@empresa.com',
            'password' => Hash::make('12345678'),
            'image' => 'imagenes_usuarios/empleado_imagen.webp',
            'active' => 0
        ]);
        $administrativo2->assignRole('Administrativo');

        // Usuario Gerente de Almacén
        $gerenteAlmacen = User::create([
            'name' => 'Pepe López',
            'email' => 'logistica@empresa.com',
            'password' => Hash::make('12345678'),
            'image' => 'imagenes_usuarios/empleado_imagen.webp',
            'active' => 1
        ]);
        $gerenteAlmacen->assignRole('Logistica');

        // Usuario Gerente
        $gerente = User::create([
            'name' => 'Homer Simpsom',
            'email' => 'gerente@gerente.com',
            'password' => Hash::make('12345678'),
            'image' => 'imagenes_usuarios/empleado_imagen.webp',
            'active' => 1
        ]);
        $gerente->assignRole('Gerente');

        // Usuario Directivo
        $directivo = User::create([
            'name' => 'Señor Burns',
            'email' => 'directivo@directivo.com',
            'password' => Hash::make('12345678'),
            'image' => 'imagenes_usuarios/empleado_imagen.webp',
            'active' => 1
        ]);
        $directivo->assignRole('Directivo');
    }
}
