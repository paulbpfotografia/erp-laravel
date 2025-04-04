<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductDetailsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * Como existen 30 productos
     *  y quieres crear 30 registros en product_details (uno por producto)
     */
    public function run(): void
    {
        //
        // Ejemplo, product_id = 1, brand = "Marca X", ...
        DB::table('product_details')->insert([
            // product_id = 1 (Iny)
            [
                'product_id'     => 1,
                'brand'          => 'SofaBrand Infinity',
                'shipping_info'  => 'Envío gratis en 3-5 días laborables.',
                'return_policy'  => 'Devolución sin coste en 30 días.',
                'warranty'       => 'Garantía de 2 años por defectos de fabricación.',
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
            // product_id = 2 (Artic)
            [
                'product_id'     => 2,
                'brand'          => 'TableMaker Co.',
                'shipping_info'  => 'Envío estándar (5-7 días). Montaje no incluido.',
                'return_policy'  => 'Devolución aceptada si conserva embalaje original.',
                'warranty'       => 'Garantía de 1 año.',
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
            // product_id = 3 (Apolo)
            [
                'product_id'     => 3,
                'brand'          => 'SoftDream Co.',
                'shipping_info'  => 'Transporte especializado (2-4 días).',
                'return_policy'  => '30 días de prueba, reembolso completo si no te convence.',
                'warranty'       => 'Garantía de 5 años en el núcleo del colchón.',
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
            // product_id = 4 (Denver)
            [
                'product_id'     => 4,
                'brand'          => 'ChairCraft Inc.',
                'shipping_info'  => 'Entrega a pie de calle en 3-5 días.',
                'return_policy'  => 'Retorno gratuito si hay defectos de fábrica.',
                'warranty'       => 'Garantía de 1.5 años.',
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
            // product_id = 5 (Horizon)
            [
                'product_id'     => 5,
                'brand'          => 'ShelfDesigners',
                'shipping_info'  => 'Envío rápido (48-72h).',
                'return_policy'  => 'Se aceptan devoluciones en 15 días.',
                'warranty'       => 'Garantía de 1 año.',
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
            // product_id = 6 (Lumen)
            [
                'product_id'     => 6,
                'brand'          => 'LightSolutions',
                'shipping_info'  => 'Transporte estándar (3-6 días).',
                'return_policy'  => '30 días para devolución por cambio de opinión.',
                'warranty'       => 'Garantía de 2 años en componentes eléctricos.',
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
            // product_id = 7 (Reflect)
            [
                'product_id'     => 7,
                'brand'          => 'MirrorVision',
                'shipping_info'  => 'Envío asegurado contra roturas.',
                'return_policy'  => 'Devolución en 14 días, coste de envío a cargo del comprador.',
                'warranty'       => 'Garantía de 1 año.',
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
            // product_id = 8 (Soft Rug)
            [
                'product_id'     => 8,
                'brand'          => 'RugArt Co.',
                'shipping_info'  => 'Envío enrollado (3-5 días).',
                'return_policy'  => 'Devolución en 30 días si no satisface.',
                'warranty'       => 'Garantía de 1 año en costuras.',
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
            // product_id = 9 (Dream)
            [
                'product_id'     => 9,
                'brand'          => 'Bedtime Bliss',
                'shipping_info'  => 'Transporte especializado, incluye subida al domicilio.',
                'return_policy'  => '30 días para cambios o devoluciones.',
                'warranty'       => 'Garantía de 2 años (estructura).',
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
            // product_id = 10 (Vision)
            [
                'product_id'     => 10,
                'brand'          => 'TVMax Studios',
                'shipping_info'  => 'Entrega en 5 días laborables.',
                'return_policy'  => 'Devolución en 15 días con reembolso parcial.',
                'warranty'       => 'Garantía de 1 año.',
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
            // product_id = 11 (Nova)
            [
                'product_id'     => 11,
                'brand'          => 'SofaBrand Premium',
                'shipping_info'  => 'Envío gratuito en 3-5 días, embalaje reforzado.',
                'return_policy'  => 'Prueba 14 días, devolución sin coste.',
                'warranty'       => 'Garantía de 3 años en tapizado.',
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
            // product_id = 12 (Delta)
            [
                'product_id'     => 12,
                'brand'          => 'TableMaker Ultra',
                'shipping_info'  => 'Entrega en 5-7 días, opción de montaje extra.',
                'return_policy'  => 'Devolución en 30 días, deben conservar embalaje.',
                'warranty'       => 'Garantía de 1 año.',
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
            // product_id = 13 (Orion)
            [
                'product_id'     => 13,
                'brand'          => 'SoftDream Clouds',
                'shipping_info'  => 'Envío de 2-3 días, incluye colocación en habitación.',
                'return_policy'  => 'Prueba 100 noches, reembolso total.',
                'warranty'       => 'Garantía de 5 años en el núcleo.',
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
            // product_id = 14 (Zen)
            [
                'product_id'     => 14,
                'brand'          => 'ChairCraft Zen',
                'shipping_info'  => 'Entrega en 3-5 días.',
                'return_policy'  => 'Devolución en 30 días, coste compartido.',
                'warranty'       => 'Garantía de 2 años en patas y estructura.',
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
            // product_id = 15 (Urban)
            [
                'product_id'     => 15,
                'brand'          => 'ShelfDesigners Urban',
                'shipping_info'  => 'Envío rápido (48h) si está en stock.',
                'return_policy'  => '15 días de devolución.',
                'warranty'       => 'Garantía de 1 año.',
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
            // product_id = 16 (Eclipse)
            [
                'product_id'     => 16,
                'brand'          => 'LightSolutions Eclipse',
                'shipping_info'  => 'Entrega estándar (4-6 días).',
                'return_policy'  => '15 días para cambios o devoluciones.',
                'warranty'       => 'Garantía de 2 años en componentes eléctricos.',
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
            // product_id = 17 (Mirage)
            [
                'product_id'     => 17,
                'brand'          => 'MirrorVision Glow',
                'shipping_info'  => 'Envío asegurado, manipulación cuidadosa.',
                'return_policy'  => 'Devolución en 14 días.',
                'warranty'       => 'Garantía de 1 año.',
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
            // product_id = 18 (Cozy)
            [
                'product_id'     => 18,
                'brand'          => 'RugArt Cozy',
                'shipping_info'  => 'Envío enrollado y protegido (2-4 días).',
                'return_policy'  => '30 días de devolución sin coste.',
                'warranty'       => 'Garantía de 1 año en costuras.',
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
            // product_id = 19 (Cloud)
            [
                'product_id'     => 19,
                'brand'          => 'Bedtime Cloud',
                'shipping_info'  => 'Servicio premium: entrega y montaje.',
                'return_policy'  => '30 días para cambios o reembolsos.',
                'warranty'       => 'Garantía de 2 años en estructura.',
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
            // product_id = 20 (Modern TV)
            [
                'product_id'     => 20,
                'brand'          => 'TVMax Modern',
                'shipping_info'  => 'Envío de 4-7 días laborables.',
                'return_policy'  => '15 días de devolución con embalaje original.',
                'warranty'       => 'Garantía de 1 año.',
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
            // product_id = 21 (Relax)
            [
                'product_id'     => 21,
                'brand'          => 'SofaBrand Relax',
                'shipping_info'  => 'Envío en 3-5 días, incluye traslado a salón.',
                'return_policy'  => '30 días, se requiere ticket de compra.',
                'warranty'       => 'Garantía de 2 años.',
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
            // product_id = 22 (Terra)
            [
                'product_id'     => 22,
                'brand'          => 'TableMaker Terra',
                'shipping_info'  => 'Entrega en 5-7 días. Montaje adicional con coste.',
                'return_policy'  => 'Devolución en 30 días si está en perfecto estado.',
                'warranty'       => 'Garantía de 1 año.',
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
            // product_id = 23 (Nimbus)
            [
                'product_id'     => 23,
                'brand'          => 'SoftDream Nimbus',
                'shipping_info'  => 'Transporte especial (2-3 días).',
                'return_policy'  => 'Prueba 60 noches.',
                'warranty'       => 'Garantía de 10 años en el núcleo.',
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
            // product_id = 24 (Vega)
            [
                'product_id'     => 24,
                'brand'          => 'ChairCraft Vega',
                'shipping_info'  => 'Entrega en 3-5 días a pie de calle.',
                'return_policy'  => '14 días, embalaje original requerido.',
                'warranty'       => 'Garantía de 2 años.',
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
            // product_id = 25 (Expand)
            [
                'product_id'     => 25,
                'brand'          => 'ShelfDesigners Expand',
                'shipping_info'  => 'Envío gratis si supera 200 €.',
                'return_policy'  => 'Devolución en 15 días.',
                'warranty'       => 'Garantía de 1 año.',
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
            // product_id = 26 (Glow)
            [
                'product_id'     => 26,
                'brand'          => 'LightSolutions Glow',
                'shipping_info'  => 'Envío estándar (4-6 días).',
                'return_policy'  => 'Cambio o devolución en 30 días.',
                'warranty'       => 'Garantía de 2 años.',
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
            // product_id = 27 (Prism)
            [
                'product_id'     => 27,
                'brand'          => 'MirrorVision Prism',
                'shipping_info'  => 'Envío con manipulación frágil (3-5 días).',
                'return_policy'  => 'Devolución en 14 días si no está dañado.',
                'warranty'       => 'Garantía de 1 año.',
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
            // product_id = 28 (Soft Comfort)
            [
                'product_id'     => 28,
                'brand'          => 'RugArt Comfort',
                'shipping_info'  => 'Despacho inmediato, llega en 2-4 días.',
                'return_policy'  => '30 días de garantía de satisfacción.',
                'warranty'       => 'Garantía de 6 meses en costuras.',
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
            // product_id = 29 (Royal)
            [
                'product_id'     => 29,
                'brand'          => 'Bedtime Royal',
                'shipping_info'  => 'Transporte premium, incluye montaje.',
                'return_policy'  => '30 días para cambios, sin coste adicional.',
                'warranty'       => 'Garantía de 2 años en estructura.',
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
            // product_id = 30 (Classic TV)
            [
                'product_id'     => 30,
                'brand'          => 'TVMax Classic',
                'shipping_info'  => 'Envío en 4-7 días laborables.',
                'return_policy'  => 'Devolución en 15 días, debe estar intacto.',
                'warranty'       => 'Garantía de 1 año.',
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
            // ...
            // Tantos registros como productos tengas
        ]);
    }
}

