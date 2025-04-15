<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CarrierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('carriers')->insert([
            [
                'name' => 'Yeclatrans S.L.',
                'phone' => '600123456',
                'email' => 'contacto@yeclatrans.com',
                'address' => 'Calle del Sol, 12, Yecla, España',
                'transport_type' => 'Camión grande',
                'max_cubic_meters' => 80.50,
                'cif' => 'B12345678',
                'rate_per_km' => 2.50,
            ],
            [
                'name' => 'Furgonetas Express Yecla',
                'phone' => '601234567',
                'email' => 'info@furgonetasexpressyecla.com',
                'address' => 'Avenida de la Constitución, 45, Yecla, España',
                'transport_type' => 'Furgoneta pequeña',
                'max_cubic_meters' => 12.00,
                'cif' => 'B98765432',
                'rate_per_km' => 1.80,
            ],
            [
                'name' => 'Logística Yecla Global',
                'phone' => '602345678',
                'email' => 'contacto@logisticayeclaglobal.com',
                'address' => 'Calle San Sebastián, 9, Yecla, España',
                'transport_type' => 'Camión articulado',
                'max_cubic_meters' => 120.00,
                'cif' => 'A11223344',
                'rate_per_km' => 3.00,
            ],
            [
                'name' => 'Transportes Altiplano',
                'phone' => '603456789',
                'email' => 'eco@transportesaltiplano.com',
                'address' => 'Calle de los Almendros, 33, Yecla, España',
                'transport_type' => 'Camión pequeño',
                'max_cubic_meters' => 40.00,
                'cif' => 'B22334455',
                'rate_per_km' => 2.20,
            ],
            [
                'name' => 'Transporte Express 24 Yecla',
                'phone' => '604567890',
                'email' => 'contacto@transporteexpress24yecla.com',
                'address' => 'Calle Mayor, 10, Yecla, España',
                'transport_type' => 'Furgoneta mediana',
                'max_cubic_meters' => 20.00,
                'cif' => 'C33445566',
                'rate_per_km' => 2.00,
            ],
            [
                'name' => 'Súper Logística Yecla',
                'phone' => '605678901',
                'email' => 'atencion@superlogisticayecla.com',
                'address' => 'Avenida del Parque, 7, Yecla, España',
                'transport_type' => 'Camión grande',
                'max_cubic_meters' => 100.00,
                'cif' => 'D44556677',
                'rate_per_km' => 2.75,
            ],
        ]);
    }
}
