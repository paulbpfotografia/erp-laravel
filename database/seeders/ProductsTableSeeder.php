<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('products')->insert([
            ['name' => 'Iny', 'description' => 'Nuevo modelo de sofá cama.', 'price' => 799.99, 'category_id' => 1, 'supplier_id' => 6, 'iva' => 21.00],
            ['name' => 'Artic', 'description' => 'Mesa confortable.', 'price' => 99.99, 'category_id' => 2, 'supplier_id' => 5, 'iva' => 4.00],
            ['name' => 'Apolo', 'description' => 'Confort en nuestro modelo.', 'price' => 149.99, 'category_id' => 3, 'supplier_id' => 8, 'iva' => 10.00],
            ['name' => 'Denver', 'description' => 'Silla ergonómica de madera.', 'price' => 129.99, 'category_id' => 4, 'supplier_id' => 5, 'iva' => 21.00],
            ['name' => 'Horizon', 'description' => 'Estantería de diseño industrial.', 'price' => 199.99, 'category_id' => 5, 'supplier_id' => 9, 'iva' => 4.00],
            ['name' => 'Lumen', 'description' => 'Lámpara de pie con luz LED.', 'price' => 89.99, 'category_id' => 6, 'supplier_id' => 2, 'iva' => 10.00],
            ['name' => 'Reflect', 'description' => 'Espejo de pared con marco de madera.', 'price' => 79.99, 'category_id' => 7, 'supplier_id' => 10, 'iva' => 21.00],
            ['name' => 'Soft Rug', 'description' => 'Alfombra suave y acogedora.', 'price' => 59.99, 'category_id' => 8, 'supplier_id' => 3, 'iva' => 21.00],
            ['name' => 'Dream', 'description' => 'Cama de matrimonio con cabecero tapizado.', 'price' => 899.99, 'category_id' => 9, 'supplier_id' => 1, 'iva' => 21.00],
            ['name' => 'Vision', 'description' => 'Mueble para TV con estantes.', 'price' => 299.99, 'category_id' => 10, 'supplier_id' => 10, 'iva' => 4.00],
            ['name' => 'Nova', 'description' => 'Sofá de dos plazas en cuero.', 'price' => 1099.99, 'category_id' => 1, 'supplier_id' => 3, 'iva' => 21.00],
            ['name' => 'Delta', 'description' => 'Mesa extensible de madera maciza.', 'price' => 399.99, 'category_id' => 2, 'supplier_id' => 7, 'iva' => 4.00],
            ['name' => 'Orion', 'description' => 'Colchón de espuma viscoelástica.', 'price' => 299.99, 'category_id' => 3, 'supplier_id' => 5, 'iva' => 4.00],
            ['name' => 'Zen', 'description' => 'Silla acolchada con patas de metal.', 'price' => 159.99, 'category_id' => 4, 'supplier_id' => 10, 'iva' => 10.00],
            ['name' => 'Urban', 'description' => 'Estantería modular con acabados modernos.', 'price' => 249.99, 'category_id' => 5, 'supplier_id' => 9, 'iva' => 21.00],
            ['name' => 'Eclipse', 'description' => 'Lámpara de techo con diseño minimalista.', 'price' => 129.99, 'category_id' => 6, 'supplier_id' => 3, 'iva' => 4.00],
            ['name' => 'Mirage', 'description' => 'Espejo decorativo con luz LED.', 'price' => 149.99, 'category_id' => 7, 'supplier_id' => 10, 'iva' => 21.00],
            ['name' => 'Cozy', 'description' => 'Alfombra grande de lana natural.', 'price' => 189.99, 'category_id' => 8, 'supplier_id' => 1, 'iva' => 10.00],
            ['name' => 'Cloud', 'description' => 'Cama individual con estructura de madera.', 'price' => 599.99, 'category_id' => 9, 'supplier_id' => 6, 'iva' => 21.00],
            ['name' => 'Modern TV', 'description' => 'Mueble para TV con compartimentos.', 'price' => 349.99, 'category_id' => 10, 'supplier_id' => 9, 'iva' => 10.00],
            ['name' => 'Relax', 'description' => 'Sofá esquinero con chaise longue.', 'price' => 1499.99, 'category_id' => 1, 'supplier_id' => 2, 'iva' => 4.00],
            ['name' => 'Terra', 'description' => 'Mesa de centro de mármol.', 'price' => 279.99, 'category_id' => 2, 'supplier_id' => 9, 'iva' => 21.00],
            ['name' => 'Nimbus', 'description' => 'Colchón híbrido de alta gama.', 'price' => 499.99, 'category_id' => 3, 'supplier_id' => 7, 'iva' => 4.00],
            ['name' => 'Vega', 'description' => 'Silla de oficina ergonómica.', 'price' => 229.99, 'category_id' => 4, 'supplier_id' => 1, 'iva' => 10.00],
            ['name' => 'Expand', 'description' => 'Estantería ajustable con múltiples niveles.', 'price' => 179.99, 'category_id' => 5, 'supplier_id' => 6, 'iva' => 10.00],
            ['name' => 'Glow', 'description' => 'Lámpara de pared con efecto cálido.', 'price' => 99.99, 'category_id' => 6, 'supplier_id' => 1, 'iva' => 10.00],
            ['name' => 'Prism', 'description' => 'Espejo con bordes redondeados.', 'price' => 119.99, 'category_id' => 7, 'supplier_id' => 10, 'iva' => 4.00],
            ['name' => 'Soft Comfort', 'description' => 'Alfombra tejida a mano.', 'price' => 129.99, 'category_id' => 8, 'supplier_id' => 1, 'iva' => 10.00],
            ['name' => 'Royal', 'description' => 'Cama King Size con base reforzada.', 'price' => 1099.99, 'category_id' => 9, 'supplier_id' => 4, 'iva' => 21.00],
            ['name' => 'Classic TV', 'description' => 'Mueble para TV de madera rústica.', 'price' => 399.99, 'category_id' => 10, 'supplier_id' => 5, 'iva' => 10.00],
        ]);
    }
}
