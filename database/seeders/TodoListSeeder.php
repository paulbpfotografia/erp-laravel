<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Todo;

class TodoListSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::where('email', 'admin@admin.com')->first();
        $administrativo1 = User::where('email', 'administrativo1@empresa.com')->first();
        $gerenteAlmacen = User::where('email', 'logistica@empresa.com')->first();
        $gerente = User::where('email', 'gerente@gerente.com')->first();
        $directivo = User::where('email', 'directivo@directivo.com')->first();

        // Admin
        $admin->todos()->createMany([
            ['task' => 'Revisar permisos del sistema', 'completed' => false],
            ['task' => 'Inahbilitar usuario Adminsitrativo 2', 'completed' => true],
        ]);

        // Administrativo activo
        $administrativo1->todos()->createMany([
            ['task' => 'Revisar pedidos pendientes', 'completed' => false],
        ]);


        // Logística
        $gerenteAlmacen->todos()->createMany([
            ['task' => 'Preparar pedidos del día', 'completed' => false],
            ['task' => 'Revisar stock de productos', 'completed' => true],
        ]);

        // Gerente
        $gerente->todos()->createMany([
            ['task' => 'Reunión con dirección', 'completed' => false],
            ['task' => 'Revisar pedidos por hacer', 'completed' => true],
        ]);

        // Directivo
        $directivo->todos()->createMany([
            ['task' => 'Analizar informe mensual', 'completed' => false],
            ['task' => 'Planificar presupuesto anual', 'completed' => false],
        ]);
    }
}
