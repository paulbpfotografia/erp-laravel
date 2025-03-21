<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CustomerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Datos de prueba
        DB::table('customers')->insert([
            ['name' => 'Carlos Ramírez', 'cif' => 'A87654321', 'address' => 'Calle Gran Vía 45, Madrid', 'phone' => '600-123456', 'email' => 'carlosr@example.com'],
            ['name' => 'Elisa Gómez', 'cif' => 'B11223344', 'address' => 'Avenida del Cid 23, Valencia', 'phone' => '600-654321', 'email' => 'elisag@example.com'],
            ['name' => 'Manuel Fernández', 'cif' => 'C55667788', 'address' => 'Paseo Marítimo 89, Málaga', 'phone' => '600-789012', 'email' => 'manuelf@example.com'],
            ['name' => 'Carlos Gómez', 'cif' => 'D22334455', 'address' => 'Calle Mayor 12, Madrid', 'phone' => '600-112233', 'email' => 'carlosg@example.com'],
            ['name' => 'Laura Fernández', 'cif' => 'E33445566', 'address' => 'Avenida de Andalucía 34, Sevilla', 'phone' => '600-445566', 'email' => 'lauraf@example.com'],
            ['name' => 'Antonio López', 'cif' => 'F44556677', 'address' => 'Paseo de la Castellana 89, Madrid', 'phone' => '600-778899', 'email' => 'antoniol@example.com'],
            ['name' => 'María Sánchez', 'cif' => 'G55667788', 'address' => 'Plaza Nueva 21, Granada', 'phone' => '600-998877', 'email' => 'marias@example.com'],
            ['name' => 'Javier Torres', 'cif' => 'H66778899', 'address' => 'Calle Serrano 15, Madrid', 'phone' => '600-334455', 'email' => 'javiert@example.com'],
            ['name' => 'Elena Ruiz', 'cif' => 'I77889900', 'address' => 'Avenida de la Constitución 50, Valencia', 'phone' => '600-556677', 'email' => 'elenar@example.com'],
            ['name' => 'Raúl Martín', 'cif' => 'J88990011', 'address' => 'Calle Colón 67, Barcelona', 'phone' => '600-112244', 'email' => 'raulm@example.com'],
            ['name' => 'Beatriz Moreno', 'cif' => 'K99001122', 'address' => 'Gran Vía 14, Madrid', 'phone' => '600-667788', 'email' => 'beatriz@example.com'],
            ['name' => 'Fernando Pérez', 'cif' => 'L00112233', 'address' => 'Calle de la Reina 99, Valencia', 'phone' => '600-889900', 'email' => 'fernandop@example.com'],
            ['name' => 'Ana Jiménez', 'cif' => 'M11223344', 'address' => 'Calle San Fernando 23, Málaga', 'phone' => '600-223344', 'email' => 'anaj@example.com'],
            ['name' => 'Pablo Herrera', 'cif' => 'N22334455', 'address' => 'Paseo Marítimo 45, Cádiz', 'phone' => '600-445577', 'email' => 'pabloh@example.com'],
            ['name' => 'Sergio Castillo', 'cif' => 'O33445566', 'address' => 'Calle Real 56, Zaragoza', 'phone' => '600-778899', 'email' => 'sergioc@example.com'],
            ['name' => 'Marta Domínguez', 'cif' => 'P44556677', 'address' => 'Rambla de Cataluña 88, Barcelona', 'phone' => '600-998877', 'email' => 'martad@example.com'],
            ['name' => 'Luis Navarro', 'cif' => 'Q55667788', 'address' => 'Calle Alcazaba 12, Almería', 'phone' => '600-334455', 'email' => 'luisn@example.com'],
            ['name' => 'Isabel Ortega', 'cif' => 'R66778899', 'address' => 'Paseo del Prado 7, Madrid', 'phone' => '600-556677', 'email' => 'isabelo@example.com'],
            ['name' => 'Daniel Vega', 'cif' => 'S77889900', 'address' => 'Avenida de la Libertad 10, Murcia', 'phone' => '600-112244', 'email' => 'danielv@example.com'],
            ['name' => 'Rosa Cano', 'cif' => 'T88990011', 'address' => 'Calle Ancha 33, Cádiz', 'phone' => '600-667788', 'email' => 'rosac@example.com'],
        ]);
    }
}
