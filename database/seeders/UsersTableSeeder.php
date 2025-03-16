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
        // Crear los usuarios y asignarles un rol
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('12345678'),
        ]);
        $admin->assignRole('Admin');

        $empleado = User::create([
            'name' => 'Empleado',
            'email' => 'empleado@empleado.com',
            'password' => Hash::make('12345678'),
        ]);
        $empleado->assignRole('Empleado');

        $gerente = User::create([
            'name' => 'Gerente',
            'email' => 'gerente@gerente.com',
            'password' => Hash::make('12345678'),
        ]);
        $gerente->assignRole('Gerente');

        $directivo = User::create([
            'name' => 'Directivo',
            'email' => 'directivo@directivo.com',
            'password' => Hash::make('12345678'),
        ]);
        $directivo->assignRole('Directivo');
    }
}