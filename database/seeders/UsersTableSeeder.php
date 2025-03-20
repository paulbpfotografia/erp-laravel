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
      
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('12345678'),
            'image' => 'imagenes_usuarios/admin_imagen.jpg'
        ]);
        $admin->assignRole('Admin');

      
        $empleado1 = User::create([
            'name' => 'Empleado1',
            'email' => 'empleado1@empleado.com',
            'password' => Hash::make('12345678'),
            'image' => 'imagenes_usuarios/empleado_imagen.webp'
        ]);
        $empleado1->assignRole('Empleado');

        $empleado2 = User::create([
            'name' => 'Empleado2',
            'email' => 'empleado2@empleado.com',
            'password' => Hash::make('12345678'),
            'image' => null, 
            'active' => '0'
        ]);
        $empleado2->assignRole('Empleado');

   
        $gerente = User::create([
            'name' => 'Gerente',
            'email' => 'gerente@gerente.com',
            'password' => Hash::make('12345678'),
            'image' => null, 
        ]);
        $gerente->assignRole('Gerente');

     
        $directivo = User::create([
            'name' => 'Directivo',
            'email' => 'directivo@directivo.com',
            'password' => Hash::make('12345678'),
            'image' => null,
        ]);
        $directivo->assignRole('Directivo');
    }
}
