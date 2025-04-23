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
            ['name' => 'Hotel Bahía de Cádiz', 'nif' => 'A12345678', 'address' => 'Av. del Puerto 12, Cádiz', 'province' => 'Cádiz', 'phone' => '600-111111', 'email' => 'contacto@bahiacadizhotel.es'],
            ['name' => 'Hotel Costa Verde', 'nif' => 'B23456789', 'address' => 'Playa de San Lorenzo, Gijón', 'province' => 'Asturias', 'phone' => '600-222222', 'email' => 'reservas@costaverdehotel.com'],
            ['name' => 'Gran Hotel Sierra Nevada', 'nif' => 'C34567890', 'address' => 'Calle Nevada 5, Granada', 'province' => 'Granada', 'phone' => '600-333333', 'email' => 'info@ghsierranevada.es'],
            ['name' => 'Hotel Atlántico Vigo', 'nif' => 'D45678901', 'address' => 'Rúa do Porto 21, Vigo', 'province' => 'Pontevedra', 'phone' => '600-444444', 'email' => 'atencion@atlanticovigo.com'],
            ['name' => 'Hotel Boutique Palma', 'nif' => 'E56789012', 'address' => 'Carrer dels Oms 7, Palma de Mallorca', 'province' => 'Illes Balears', 'phone' => '600-555555', 'email' => 'contacto@boutiquepalma.es'],
            ['name' => 'Hotel del Mar Alicante', 'nif' => 'F67890123', 'address' => 'Paseo de la Explanada 33, Alicante', 'province' => 'Alicante', 'phone' => '600-666666', 'email' => 'info@hoteldelmaralicante.com'],
            ['name' => 'Hotel Sierra y Sol', 'nif' => 'G78901234', 'address' => 'Camino de Ronda 91, Granada', 'province' => 'Granada', 'phone' => '600-777777', 'email' => 'contacto@sierraysolhotel.es'],
            ['name' => 'Hotel Mirador del Ebro', 'nif' => 'H89012345', 'address' => 'Calle del Puente 10, Logroño', 'province' => 'La Rioja', 'phone' => '600-888888', 'email' => 'reservas@miradorebro.com'],
            ['name' => 'Hotel Montaña Azul', 'nif' => 'I90123456', 'address' => 'Calle Mayor 22, León', 'province' => 'León', 'phone' => '600-999999', 'email' => 'info@montanaazulhotel.es'],
            ['name' => 'Hotel Real Santander', 'nif' => 'J01234567', 'address' => 'Paseo de Pereda 18, Santander', 'province' => 'Cantabria', 'phone' => '600-121212', 'email' => 'real@santanderhotel.com'],
            ['name' => 'Hotel Mediterráneo Valencia', 'nif' => 'K12345678', 'address' => 'Av. del Cid 101, Valencia', 'province' => 'Valencia', 'phone' => '600-232323', 'email' => 'mediterraneo@valenciahoteles.es'],
            ['name' => 'Hotel Sol y Playa', 'nif' => 'L23456789', 'address' => 'Paseo Marítimo 45, Marbella', 'province' => 'Málaga', 'phone' => '600-343434', 'email' => 'contacto@solyplaya.es'],
            ['name' => 'Hotel Palacio Toledo', 'nif' => 'M34567890', 'address' => 'Calle Alfileritos 11, Toledo', 'province' => 'Toledo', 'phone' => '600-454545', 'email' => 'info@palaciotoledo.com'],
            ['name' => 'Hotel Jardines del Teide', 'nif' => 'N45678901', 'address' => 'Av. de los Volcanes 89, Tenerife', 'province' => 'Santa Cruz de Tenerife', 'phone' => '600-565656', 'email' => 'reservas@jardinesteide.es'],
            ['name' => 'Hotel Ronda Norte', 'nif' => 'O56789012', 'address' => 'Ronda Norte 9, Zaragoza', 'province' => 'Zaragoza', 'phone' => '600-676767', 'email' => 'info@rondanortehotel.es'],
            ['name' => 'Hotel Castillo Medieval', 'nif' => 'P67890123', 'address' => 'Calle del Castillo 1, Segovia', 'province' => 'Segovia', 'phone' => '600-787878', 'email' => 'castillo@medievalhotel.es'],
            ['name' => 'Hotel Las Dunas', 'nif' => 'Q78901234', 'address' => 'Calle Marismas 32, Huelva', 'province' => 'Huelva', 'phone' => '600-898989', 'email' => 'info@lasdunashotel.es'],
            ['name' => 'Hotel Montaña Pirenaica', 'nif' => 'R89012345', 'address' => 'Plaza Mayor 8, Jaca', 'province' => 'Huesca', 'phone' => '600-909090', 'email' => 'reservas@montanapirenaica.com'],
            ['name' => 'Hotel Alhambra Palace', 'nif' => 'S90123456', 'address' => 'Cuesta Gomérez 2, Granada', 'province' => 'Granada', 'phone' => '600-010101', 'email' => 'alhambra@palacehotel.es'],
            ['name' => 'Hotel Torre del Oro', 'nif' => 'T01234567', 'address' => 'Av. de la Constitución 40, Sevilla', 'province' => 'Sevilla', 'phone' => '600-121314', 'email' => 'torreoro@hotelsevilla.com'],
            ['name' => 'Hotel Don Quijote', 'nif' => 'U12345678', 'address' => 'Calle Cervantes 7, Ciudad Real', 'province' => 'Ciudad Real', 'phone' => '600-131415', 'email' => 'donquijote@hotelcr.es'],
            ['name' => 'Hotel Costa de Luz', 'nif' => 'V23456789', 'address' => 'Av. de la Libertad 4, Almería', 'province' => 'Almería', 'phone' => '600-141516', 'email' => 'info@costadeluzhotel.com'],
            ['name' => 'Hotel Islas Cíes', 'nif' => 'W34567890', 'address' => 'Calle Laxe 23, Vigo', 'province' => 'Pontevedra', 'phone' => '600-151617', 'email' => 'reservas@islascieshotel.es'],
            ['name' => 'Hotel Los Pirineos', 'nif' => 'X45678901', 'address' => 'Av. de los Pirineos 19, Huesca', 'province' => 'Huesca', 'phone' => '600-161718', 'email' => 'pirineos@hotelalpes.es'],
            ['name' => 'Hotel Rústico Ribeira Sacra', 'nif' => 'Y56789012', 'address' => 'Lugar Castro 12, Lugo', 'province' => 'Lugo', 'phone' => '600-171819', 'email' => 'info@ribeirasacrahotel.com'],
            ['name' => 'Hotel Costa Vasca', 'nif' => 'Z67890123', 'address' => 'Paseo de la Concha 17, San Sebastián', 'province' => 'Guipúzcoa', 'phone' => '600-181920', 'email' => 'reservas@costavasca.es'],
            ['name' => 'Hotel Plaza Mayor', 'nif' => 'A78901234', 'address' => 'Plaza Mayor 1, Salamanca', 'province' => 'Salamanca', 'phone' => '600-192021', 'email' => 'info@hotelplazamayor.es'],
            ['name' => 'Hotel Santuario', 'nif' => 'B89012345', 'address' => 'Calle Abadía 8, Ávila', 'province' => 'Ávila', 'phone' => '600-202122', 'email' => 'santuario@hotelavila.es'],
            ['name' => 'Hotel Muro de Ronda', 'nif' => 'C90123456', 'address' => 'Calle Arco 6, Ronda', 'province' => 'Málaga', 'phone' => '600-212223', 'email' => 'info@muroredonda.com'],
            ['name' => 'Hotel Faro del Sur', 'nif' => 'D01234567', 'address' => 'Av. del Atlántico 99, Cádiz', 'province' => 'Cádiz', 'phone' => '600-222324', 'email' => 'reservas@farosurhotel.es'],
            ['name' => 'Espinosa, Pellicer and Alcántara', 'nif' => 'gNB21690484', 'address' => 'C. Isaura Gonzalez 91, Alicante, 72483', 'province' => 'Sevilla', 'phone' => '+34674 067 172', 'email' => 'xcarbajo@royo-torrijos.com'],
            ['name' => 'Haro, Castells and Castell', 'nif' => 'uxG93718418', 'address' => 'Acceso Eugenio Ribes 66 Apt. 32 , Guadalajara, 79105', 'province' => 'Lugo', 'phone' => '+34626 313 400', 'email' => 'gala98@macias.com'],
            ['name' => 'Gual Ltd', 'nif' => 'zBq59935586', 'address' => 'Callejón Olalla Morales 899, Lugo, 35899', 'province' => 'Sevilla', 'phone' => '+34965 890 014', 'email' => 'lermairene@cordero.org'],
            ['name' => 'Reig-Anaya', 'nif' => 'baX28652082', 'address' => 'Rambla de Juan Carlos Puga 35 Apt. 61 , Lleida, 52594', 'province' => 'Córdoba', 'phone' => '+34887 40 19 29', 'email' => 'alma34@torralba.com'],
            ['name' => 'Ferrer Ltd', 'nif' => 'taX78322188', 'address' => 'Calle de Fernanda Serrano 176 Puerta 8 , Badajoz, 20977', 'province' => 'Madrid', 'phone' => '+34 847 153 366', 'email' => 'miguelsarita@cases.org'],
            ['name' => 'Alvarez-Muñoz', 'nif' => 'YuM39815678', 'address' => 'Vial de Tatiana Gilabert 7, Girona, 63303', 'province' => 'Sevilla', 'phone' => '+34705 44 21 92', 'email' => 'wblasco@aguilar-bermudez.es'],
            ['name' => 'Gual Ltd', 'nif' => 'pkO67754277', 'address' => 'Urbanización de Timoteo Vargas 972 Piso 4 , Vizcaya, 34164', 'province' => 'Zamora', 'phone' => '+34 713 917 877', 'email' => 'ofeliamiguel@parejo.com'],
            ['name' => 'Quintanilla, Flores and Losada', 'nif' => 'SdM64577355', 'address' => 'Paseo de Rolando Pereira 6 Piso 7 , Lleida, 51327', 'province' => 'Madrid', 'phone' => '+34887 14 35 17', 'email' => 'rupertohurtado@giron.es'],
            ['name' => 'Girona-Larrañaga', 'nif' => 'JNK37618165', 'address' => 'Calle Ariadna Saura 53 Piso 1 , Teruel, 81151', 'province' => 'Sevilla', 'phone' => '+34 651319972', 'email' => 'viviana18@morante.es'],
            ['name' => 'Ordóñez Ltd', 'nif' => 'Gbj30022328', 'address' => 'Acceso de Juanito Mateo 79, Cádiz, 83494', 'province' => 'Lugo', 'phone' => '+34724826406', 'email' => 'lorenzacalzada@villalobos.es'],

        ];


        $provinces = DB::table('provinces')->pluck('id', 'name')->toArray();

        foreach ($customers as $customer) {
            $provinceId = isset($customer['province']) && isset($provinces[$customer['province']])
                ? $provinces[$customer['province']]
                : null;

            DB::table('customers')->insert([
                'name' => $customer['name'],
                'nif' => $customer['nif'],
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
