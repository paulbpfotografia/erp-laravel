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
                'description'    => 'Iny es un sofá cama de diseño moderno y sofisticado, ideal para optimizar espacios en hoteles,
                oficinas y residencias. Con un acabado en color gris que combina a la perfección con diversos estilos decorativos,
                Iny ofrece el equilibrio perfecto entre funcionalidad y estética. Su estructura robusta de madera y su tapizado en
                tela de alta calidad garantizan durabilidad y resistencia, proporcionando comodidad en su uso como sofá y eficiencia
                en su transformación a cama cuando se necesita más espacio. Gracias a su mecanismo sencillo de operación, el sofá cama
                Iny se adapta rápidamente a las necesidades del entorno, ofreciendo versatilidad y practicidad sin sacrificar estilo ni confort.
                Esta pieza se distingue por su diseño innovador, que conjuga eficiencia, calidad y seguridad, convirtiéndolo en la opción ideal para
                quienes buscan un mueble que combine funcionalidad con elegancia.',
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
            // product_id = 2 (Artic)
            [
                'product_id'     => 2,
                'description'    => 'Artic es una mesa elegante diseñada para entornos modernos. Su acabado en madera realza el carácter del mueble, proporcionando una superficie amplia y resistente para reuniones, comidas o espacios de trabajo. Su diseño funcional se integra a la perfección en ambientes tanto residenciales como comerciales, aportando calidez y estilo',
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
            // product_id = 3 (Apolo)
            [
                'product_id'     => 3,
                'description'    => 'Apolo es un colchón que redefine el descanso. Utilizando tecnología avanzada de espuma viscoelástica, Apolo se adapta a la forma del cuerpo, aliviando puntos de presión y asegurando un sueño reparador. Su diseño cuidado y materiales de alta calidad garantizan durabilidad y confort, siendo la elección ideal para un descanso saludable.',
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
            // product_id = 4 (Denver)
            [
                'product_id'     => 4,
                'description'    => 'Denver es una silla ergonómica, creada para quienes buscan comodidad y estilo durante largas horas de trabajo o reuniones. Con una estructura robusta en madera y un asiento bien acolchado, Denver ofrece soporte óptimo y un diseño contemporáneo, perfecto para entornos de oficina o espacios de coworking.',
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
            // product_id = 5 (Horizon)
            [
                'product_id'     => 5,
                'description'    => 'Horizon es una estantería de diseño industrial que combina funcionalidad y estética. Con un acabado en tonos naturales, Horizon organiza espacios con elegancia, convirtiéndose en el centro de atención en oficinas, hogares y locales comerciales, aportando orden y un toque moderno.',
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
            // product_id = 6 (Lumen)
            [
                'product_id'     => 6,
                'description'    => 'Lumen es una lámpara de pie de diseño minimalista que ilumina con eficiencia y estilo. Su luz LED ofrece una iluminación cálida y uniforme, ideal para crear ambientes acogedores en salones, oficinas o áreas de descanso. Su estructura moderna y eficiente es sinónimo de calidad y durabilidad.',
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
            // product_id = 7 (Reflect)
            [
                'product_id'     => 7,
                'description'    => 'Reflect es un espejo decorativo que aporta sofisticación y amplitud a cualquier espacio. Con un marco de madera y un acabado cuidado, Reflect no sólo cumple su función práctica de ampliar visualmente ambientes, sino que también actúa como pieza central en la decoración de interiores modernos y clásicos.',
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
            // product_id = 8 (Soft Rug)
            [
                'product_id'     => 8,
                'description'    => 'Soft Rug es una alfombra artesanal diseñada para dotar de calidez y textura a los espacios. Su tejido suave y diseño elegante la hacen ideal para salones, dormitorios y áreas de reunión, ofreciendo confort y un toque distintivo que eleva la decoración.',
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
            // product_id = 9 (Dream)
            [
                'product_id'     => 9,
                'description'    => 'Dream es una cama de matrimonio que combina sofisticación y funcionalidad en un solo mueble. Con un cabecero tapizado y una estructura robusta, Dream ofrece un espacio de descanso confortable y elegante, adecuado para crear ambientes de lujo en dormitorios modernos.',
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
            // product_id = 10 (Vision)
            [
                'product_id'     => 10,
                'description'    => 'Vision es un mueble para TV que une diseño contemporáneo y funcionalidad. Equipado con estantes integrados, este mueble organiza el espacio de forma inteligente, siendo el complemento perfecto para salas de estar y áreas de entretenimiento, donde la estética y la organización son clave.',
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
            // product_id = 11 (Nova)
            [
                'product_id'     => 11,
                'description'    => 'Nova es un sofá de dos plazas tapizado en cuero, que irradia sofisticación y confort. Su diseño moderno y acabado premium lo convierten en la elección ideal para espacios residenciales y ejecutivos, fusionando estilo con durabilidad.',
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
            // product_id = 12 (Delta)
            [
                'product_id'     => 12,
                'description'    => 'Delta es una mesa extensible de madera maciza, perfecta para adaptarse a diversas situaciones. Su diseño versátil permite ampliar su superficie según la necesidad del momento, y sus acabados naturales realzan la belleza de la madera, aportando elegancia y funcionalidad.',
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
            // product_id = 13 (Orion)
            [
                'product_id'     => 13,
                'description'    => 'Orion es un colchón de espuma viscoelástica diseñado para ofrecer un descanso profundo y confortable. Gracias a su tecnología de adaptación corporal, Orion distribuye el peso de manera uniforme, reduciendo puntos de presión y garantizando un sueño reparador y saludable.',
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
            // product_id = 14 (Zen)
            [
                'product_id'     => 14,
                'description'    => 'Zen es una silla con un diseño simple y elegante, pensada para promover el confort y la ergonomía. Su diseño equilibrado y sus acabados modernos hacen de Zen una opción perfecta para oficinas y espacios de trabajo, donde la comodidad es primordial.',
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
            // product_id = 15 (Urban)
            [
                'product_id'     => 15,
                'description'    => 'Urban es una estantería modular que se adapta a las necesidades de organización en ambientes modernos. Su sistema ajustable permite configurarla de múltiples formas, mientras que su diseño contemporáneo y acabado en tonos neutros la hacen perfecta para oficinas y hogares que buscan orden y estilo.',
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
            // product_id = 16 (Eclipse)
            [
                'product_id'     => 16,
                'description'    => 'Eclipse es una lámpara de techo que destaca por su simplicidad y eficiencia. Su luz LED, combinada con un diseño minimalista, crea un ambiente cálido y acogedor, ideal para espacios residenciales y comerciales que valoran la combinación de forma y función.',
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
            // product_id = 17 (Mirage)
            [
                'product_id'     => 17,
                'description'    => 'Mirage es un espejo decorativo que incorpora detalles modernos, como iluminación LED integrada, para realzar cualquier espacio. Con un diseño refinado y un marco sutil, Mirage añade un toque de sofisticación y amplitud, convirtiéndolo en un elemento clave en la decoración de interiores.',
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
            // product_id = 18 (Cozy)
            [
                'product_id'     => 18,
                'description'    => 'Cozy es una alfombra de gran tamaño que aporta una sensación de confort y calidez. Tejida con materiales naturales y con un diseño elegante, Cozy transforma cualquier espacio en un área acogedora, combinando tradición y modernidad en un solo mueble textil.',
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
            // product_id = 19 (Cloud)
            [
                'product_id'     => 19,
                'description'    => 'Cloud es una cama individual con una estructura de madera diseñada para ofrecer confort en espacios reducidos. Su diseño compacto y moderno la hace ideal para habitaciones de huéspedes o dormitorios en entornos urbanos, garantizando calidad y funcionalidad en cada detalle.',
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
            // product_id = 20 (Modern TV)
            [
                'product_id'     => 20,
                'description'    => 'Modern TV es un mueble para TV que combina funcionalidad e innovación en su diseño. Equipado con compartimentos inteligentes para almacenar dispositivos y accesorios, Modern TV optimiza el espacio y se integra de manera armónica en ambientes modernos.',
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
            // product_id = 21 (Relax)
            [
                'product_id'     => 21,
                'description'    => 'Relax es un sofá esquinero con chaise longue que aporta una experiencia de confort inigualable. Su amplio diseño, junto a materiales de primera calidad, permite disfrutar de momentos de descanso y recreación en un ambiente sofisticado y acogedor.',
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
            // product_id = 22 (Terra)
            [
                'product_id'     => 22,
                'description'    => 'Terra es una mesa de centro con acabado en mármol, diseñada para brindar un toque de lujo y modernidad. Su combinación de materiales de alta calidad y su diseño elegante la hacen perfecta para salones que buscan una pieza central de distinción y estilo.',
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
            // product_id = 23 (Nimbus)
            [
                'product_id'     => 23,
                'description'    => 'Nimbus es un colchón híbrido que fusiona lo mejor de dos mundos: muelles y espuma viscoelástica. Esto le permite adaptarse perfectamente a la forma del cuerpo, ofreciendo un soporte óptimo, alivio en los puntos de presión y un descanso profundo y reparador.',
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
            // product_id = 24 (Vega)
            [
                'product_id'     => 24,
                'description'    => 'Vega es una silla de oficina ergonómica diseñada para brindar comodidad durante jornadas laborales prolongadas. Su estructura robusta y su diseño ajustable aseguran una postura saludable, convirtiéndola en una opción imprescindible para espacios corporativos.',
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
            // product_id = 25 (Expand)
            [
                'product_id'     => 25,
                'description'    => 'Expand es una estantería ajustable con múltiples niveles que se adapta a las necesidades de organización en espacios variables. Con un diseño modular y elegante, Expand combina versatilidad y estilo, ofreciendo soluciones prácticas tanto para oficinas como para hogares modernos.',
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
            // product_id = 26 (Glow)
            [
                'product_id'     => 26,
                'description'    => 'Glow es una lámpara de pared que emite una luz cálida y acogedora, ideal para ambientes íntimos. Su diseño contemporáneo, junto a una eficiente tecnología LED, hace de Glow una pieza funcional y decorativa, perfecta para realzar la atmósfera de cualquier espacio.',
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
            // product_id = 27 (Prism)
            [
                'product_id'     => 27,
                'description'    => 'Prism es un espejo de diseño moderno con bordes redondeados que aporta sofisticación a cualquier ambiente. Con un acabado refinado, Prism no solo cumple su función práctica, sino que también actúa como un elemento decorativo que amplía visualmente los espacios.',
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
            // product_id = 28 (Soft Comfort)
            [
                'product_id'     => 28,
                'description'    => 'Soft Comfort es una alfombra artesanal que ofrece una sensación excepcional de suavidad y calidez. Su tejido hecho a mano y el uso de materiales naturales la convierten en una opción única para transformar cualquier área en un lugar acogedor y elegante.',
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
            // product_id = 29 (Royal)
            [
                'product_id'     => 29,
                'description'    => 'Royal es una cama king size diseñada para proporcionar un descanso de lujo. Con una estructura reforzada y acabados de alta calidad, Royal garantiza estabilidad, confort y elegancia, convirtiéndola en la opción perfecta para dormitorios de alto nivel.',
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
            // product_id = 30 (Classic TV)
            [
                'product_id'     => 30,
                'description'    => 'Classic TV es un mueble para TV con un diseño rústico y atemporal que realza la decoración de cualquier sala. Con compartimentos inteligentes y acabados en madera, Classic TV combina tradición y modernidad, ofreciendo una solución práctica y estética para el entretenimiento en el hogar.',
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
            // ...
            // Tantos registros como productos tengas
        ]);
    }
}
