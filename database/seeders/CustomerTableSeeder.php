<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CustomerTableSeeder extends Seeder
{
    public function run(): void
    {
        $customers = [
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
            ['name' => 'Andrés Moreno', 'cif' => 'U12345678', 'address' => 'Avenida del Mar 1, Castellón', 'phone' => '600-101010', 'email' => 'andresm@example.com'],
            ['name' => 'Clara Rivas', 'cif' => 'V23456789', 'address' => 'Calle Alta 22, Zaragoza', 'phone' => '600-202020', 'email' => 'clarar@example.com'],
            ['name' => 'Hugo Delgado', 'cif' => 'W34567890', 'address' => 'Paseo del Sol 33, Almería', 'phone' => '600-303030', 'email' => 'hugod@example.com'],
            ['name' => 'Paula Herrera', 'cif' => 'X45678901', 'address' => 'Calle Luna 44, Sevilla', 'phone' => '600-404040', 'email' => 'paulah@example.com'],
            ['name' => 'Marcos Vidal', 'cif' => 'Y56789012', 'address' => 'Camino Viejo 55, León', 'phone' => '600-505050', 'email' => 'marcosv@example.com'],
            ['name' => 'Sofía Cano', 'cif' => 'Z67890123', 'address' => 'Ronda Sur 66, Murcia', 'phone' => '600-606060', 'email' => 'sofiac@example.com'],
            ['name' => 'Álvaro Peña', 'cif' => 'A78901234', 'address' => 'Calle Norte 77, Lugo', 'phone' => '600-707070', 'email' => 'alvarop@example.com'],
            ['name' => 'Irene Bravo', 'cif' => 'B89012345', 'address' => 'Plaza Mayor 88, Salamanca', 'phone' => '600-808080', 'email' => 'ireneb@example.com'],
            ['name' => 'Diego Torres', 'cif' => 'C90123456', 'address' => 'Calle Río 99, Huesca', 'phone' => '600-909090', 'email' => 'diegot@example.com'],
            ['name' => 'Noelia Serrano', 'cif' => 'D01234567', 'address' => 'Avenida Este 100, Badajoz', 'phone' => '600-111122', 'email' => 'noelias@example.com'],
            ['name' => 'Lucas Navarro', 'cif' => 'E12345678', 'address' => 'Calle del Parque 101, Valladolid', 'phone' => '600-222233', 'email' => 'lucasn@example.com'],
            ['name' => 'Eva Montes', 'cif' => 'F23456789', 'address' => 'Calle Prado 102, Segovia', 'phone' => '600-333344', 'email' => 'evam@example.com'],
            ['name' => 'Rubén Romero', 'cif' => 'G34567890', 'address' => 'Calle Senda 103, Burgos', 'phone' => '600-444455', 'email' => 'rubenr@example.com'],
            ['name' => 'Silvia Domínguez', 'cif' => 'H45678901', 'address' => 'Calle Río Duero 104, Ávila', 'phone' => '600-555566', 'email' => 'silviad@example.com'],
            ['name' => 'Adrián Castro', 'cif' => 'I56789012', 'address' => 'Calle Jardines 105, Toledo', 'phone' => '600-666677', 'email' => 'adrianc@example.com'],
            ['name' => 'Natalia Suárez', 'cif' => 'J67890123', 'address' => 'Calle Estación 106, Cuenca', 'phone' => '600-777788', 'email' => 'natalias@example.com'],
            ['name' => 'Jorge Medina', 'cif' => 'K78901234', 'address' => 'Calle Viento 107, Teruel', 'phone' => '600-888899', 'email' => 'jorgem@example.com'],
            ['name' => 'Carmen Ibáñez', 'cif' => 'L89012345', 'address' => 'Paseo Alameda 108, Navarra', 'phone' => '600-999900', 'email' => 'carmeni@example.com'],
            ['name' => 'Mateo Vidal', 'cif' => 'M90123456', 'address' => 'Calle Olmo 109, La Rioja', 'phone' => '600-123123', 'email' => 'mateov@example.com'],
            ['name' => 'Lucía Romero', 'cif' => 'N01234567', 'address' => 'Calle Laurel 110, Ourense', 'phone' => '600-456456', 'email' => 'luciar@example.com'],
        ];

        $provinces = DB::table('provinces')->pluck('id', 'name')->toArray();

        foreach ($customers as $customer) {
            $provinceName = collect(array_keys($provinces))->first(function ($prov) use ($customer) {
                return Str::contains(Str::lower($customer['address']), Str::lower($prov));
            });

            $provinceId = $provinceName ? $provinces[$provinceName] : null;

            DB::table('customers')->insert([
                'name' => $customer['name'],
                'cif' => $customer['cif'],
                'address' => $customer['address'],
                'phone' => $customer['phone'],
                'email' => $customer['email'],
                'province_id' => $provinceId,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
