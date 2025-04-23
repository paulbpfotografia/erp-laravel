<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SupplierSeeder extends Seeder
{
    public function run(): void
    {
        $suppliers = [
            ['name' => 'Colchones Relax S.A.', 'nif' => 'fLB10433218', 'email' => 'andresciro@guerrero.com', 'bank_account' => '83863794026542351161'],
            ['name' => 'Sueños del Sur SL', 'nif' => 'yfJ55940781', 'email' => 'paula95@fernandez.net', 'bank_account' => '41316475255341928327'],
            ['name' => 'Muebles Europa', 'nif' => 'Zuz64835030', 'email' => 'blas39@miranda.es', 'bank_account' => '72423884969653287101'],
            ['name' => 'Descanso Total S.L.', 'nif' => 'DHq22691669', 'email' => 'carboisabel@lasa.org', 'bank_account' => '62704828148932528809'],
            ['name' => 'Innovacolchón S.A.', 'nif' => 'pKf57015430', 'email' => 'torreolalla@casas.es', 'bank_account' => '82489638346578713315'],
            ['name' => 'SomniArt España', 'nif' => 'TOd09839301', 'email' => 'borjaangulo@belda-vilaplana.net', 'bank_account' => '47382997376311656670'],
            ['name' => 'EcoMueble XXI', 'nif' => 'ICi10651333', 'email' => 'respanol@iborra-benet.es', 'bank_account' => '81080132677360260647'],
            ['name' => 'HogarConfort SL', 'nif' => 'dLV46872343', 'email' => 'mirbaudelio@tapia.com', 'bank_account' => '08121913619399091699'],
            ['name' => 'Flexicomfort S.A.', 'nif' => 'iQP85435346', 'email' => 'zacarias51@sedano.com', 'bank_account' => '18384251354278498084'],
            ['name' => 'NaturDescanso SL', 'nif' => 'sMn12411824', 'email' => 'herminio48@iglesias-azcona.com', 'bank_account' => '64005242786801128059'],
        ];

        DB::table('suppliers')->insert($suppliers);
    }
}
