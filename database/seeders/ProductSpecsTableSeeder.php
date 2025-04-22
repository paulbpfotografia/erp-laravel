<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSpecsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('product_specs')->insert([
            // 1: Iny (Sofá)
            [
                'product_id' => 1,
                'weight' => 40,
                'dimensions' => '200x85x90 cm',
                'color' => 'Gris',
                'material' => 'Madera + Tela',
                'packaged_volume' => 1.53,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // 2: Artic (Mesa)
            [
                'product_id' => 2,
                'weight' => 20,
                'dimensions' => '130x70x75 cm',
                'color' => 'Marrón',
                'material' => 'Madera',
                'packaged_volume' => 0.682,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // 3: Apolo (Colchón)
            [
                'product_id' => 3,
                'weight' => 12,
                'dimensions' => '190x90x25 cm',
                'color' => 'Blanco',
                'material' => 'Viscoelástica',
                'packaged_volume' => 0.427,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // 4: Denver (Silla)
            [
                'product_id' => 4,
                'weight' => 8,
                'dimensions' => '50x50x85 cm',
                'color' => 'Negro',
                'material' => 'Metal + Tela',
                'packaged_volume' => 0.212,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // 5: Horizon (Estantería)
            [
                'product_id' => 5,
                'weight' => 25,
                'dimensions' => '80x30x180 cm',
                'color' => 'Roble',
                'material' => 'Madera + Metal',
                'packaged_volume' => 0.432,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // 6: Lumen (Lámpara)
            [
                'product_id' => 6,
                'weight' => 5,
                'dimensions' => '30x30x150 cm',
                'color' => 'Blanco',
                'material' => 'Aluminio',
                'packaged_volume' => 0.135,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // 7: Reflect (Espejo)
            [
                'product_id' => 7,
                'weight' => 7,
                'dimensions' => '60x80 cm',
                'color' => 'Plateado',
                'material' => 'Cristal + Marco',
                'packaged_volume' => 0.024,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // 8: Soft Rug (Alfombra)
            [
                'product_id' => 8,
                'weight' => 4,
                'dimensions' => '150x200 cm',
                'color' => 'Crema',
                'material' => 'Algodón',
                'packaged_volume' => 0.15,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // 9: Dream (Cama)
            [
                'product_id' => 9,
                'weight' => 50,
                'dimensions' => '200x160x100 cm',
                'color' => 'Marrón',
                'material' => 'Madera + Tapizado',
                'packaged_volume' => 3.2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // 10: Vision (Mueble TV)
            [
                'product_id' => 10,
                'weight' => 30,
                'dimensions' => '120x40x50 cm',
                'color' => 'Nogal',
                'material' => 'Madera',
                'packaged_volume' => 0.24,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // 11: Nova (Sofá)
            [
                'product_id' => 11,
                'weight' => 42,
                'dimensions' => '210x90x95 cm',
                'color' => 'Marrón',
                'material' => 'Madera + Cuero',
                'packaged_volume' => 1.796,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // 12: Delta (Mesa)
            [
                'product_id' => 12,
                'weight' => 25,
                'dimensions' => '160x80x75 cm',
                'color' => 'Natural',
                'material' => 'Madera maciza',
                'packaged_volume' => 0.96,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // 13: Orion (Colchón)
            [
                'product_id' => 13,
                'weight' => 13,
                'dimensions' => '190x90x26 cm',
                'color' => 'Blanco',
                'material' => 'Espuma viscoelástica',
                'packaged_volume' => 0.445,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // 14: Zen (Silla)
            [
                'product_id' => 14,
                'weight' => 7,
                'dimensions' => '48x48x85 cm',
                'color' => 'Gris',
                'material' => 'Metal + Tela',
                'packaged_volume' => 0.196,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // 15: Urban (Estantería)
            [
                'product_id' => 15,
                'weight' => 27,
                'dimensions' => '90x35x190 cm',
                'color' => 'Gris antracita',
                'material' => 'Madera + Metal',
                'packaged_volume' => 0.599,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // 16: Eclipse (Lámpara)
            [
                'product_id' => 16,
                'weight' => 3,
                'dimensions' => '25x25x120 cm',
                'color' => 'Negro',
                'material' => 'Metal',
                'packaged_volume' => 0.075,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // 17: Mirage (Espejo)
            [
                'product_id' => 17,
                'weight' => 8,
                'dimensions' => '70x90 cm',
                'color' => 'Blanco',
                'material' => 'Cristal + Marco LED',
                'packaged_volume' => 0.032,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // 18: Cozy (Alfombra)
            [
                'product_id' => 18,
                'weight' => 6,
                'dimensions' => '170x240 cm',
                'color' => 'Beige',
                'material' => 'Lana natural',
                'packaged_volume' => 0.204,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // 19: Cloud (Cama)
            [
                'product_id' => 19,
                'weight' => 48,
                'dimensions' => '190x90x100 cm',
                'color' => 'Blanco',
                'material' => 'Madera',
                'packaged_volume' => 1.71,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // 20: Modern TV (Mueble TV)
            [
                'product_id' => 20,
                'weight' => 28,
                'dimensions' => '130x40x50 cm',
                'color' => 'Blanco',
                'material' => 'MDF',
                'packaged_volume' => 0.26,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // 21: Relax (Sofá)
            [
                'product_id' => 21,
                'weight' => 60,
                'dimensions' => '250x90x95 cm',
                'color' => 'Gris oscuro',
                'material' => 'Madera + Tela + Chaise longue',
                'packaged_volume' => 2.138,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // 22: Terra (Mesa)
            [
                'product_id' => 22,
                'weight' => 18,
                'dimensions' => '110x60x45 cm',
                'color' => 'Mármol blanco',
                'material' => 'Mármol + Metal',
                'packaged_volume' => 0.297,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // 23: Nimbus (Colchón)
            [
                'product_id' => 23,
                'weight' => 14,
                'dimensions' => '200x100x27 cm',
                'color' => 'Blanco/Gris',
                'material' => 'Híbrido (muelles + visco)',
                'packaged_volume' => 0.54,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // 24: Vega (Silla)
            [
                'product_id' => 24,
                'weight' => 10,
                'dimensions' => '60x60x100 cm',
                'color' => 'Negro',
                'material' => 'Metal + Tela ergonómica',
                'packaged_volume' => 0.36,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // 25: Expand (Estantería)
            [
                'product_id' => 25,
                'weight' => 22,
                'dimensions' => '70-120x30x180 cm (ajustable)',
                'color' => 'Blanco',
                'material' => 'Madera contrachapada',
                'packaged_volume' => 0.378,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // 26: Glow (Lámpara)
            [
                'product_id' => 26,
                'weight' => 4,
                'dimensions' => '20x20x50 cm',
                'color' => 'Marrón claro',
                'material' => 'Madera + Pantalla textil',
                'packaged_volume' => 0.02,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // 27: Prism (Espejo)
            [
                'product_id' => 27,
                'weight' => 6,
                'dimensions' => '50x70 cm',
                'color' => 'Oro',
                'material' => 'Cristal + Marco metálico',
                'packaged_volume' => 0.018,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // 28: Soft Comfort (Alfombra)
            [
                'product_id' => 28,
                'weight' => 5,
                'dimensions' => '140x200 cm',
                'color' => 'Gris claro',
                'material' => 'Tejido a mano (algodón)',
                'packaged_volume' => 0.14,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // 29: Royal (Cama)
            [
                'product_id' => 29,
                'weight' => 55,
                'dimensions' => '200x180x110 cm',
                'color' => 'Beige',
                'material' => 'Madera reforzada + Tapizado',
                'packaged_volume' => 3.96,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // 30: Classic TV (Mueble TV)
            [
                'product_id' => 30,
                'weight' => 35,
                'dimensions' => '140x45x55 cm',
                'color' => 'Madera rústica',
                'material' => 'Madera maciza',
                'packaged_volume' => 0.346,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
