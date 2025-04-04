<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductReviewsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('product_reviews')->insert([
            [
                'product_id'  => 1,
                'customer_id' => 3,  // Manuel Fernández
                'rating'      => 4,
                'comment'     => 'El sofá “Iny” es muy cómodo y fácil de montar.',
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'product_id'  => 2,
                'customer_id' => 5,  // Laura Fernández
                'rating'      => 5,
                'comment'     => 'Mesa “Artic” con un diseño excelente. ¡Recomendada!',
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'product_id'  => 3,
                'customer_id' => 10, // Raúl Martín
                'rating'      => 3,
                'comment'     => 'El colchón “Apolo” está bien, aunque un poco firme para mi gusto.',
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'product_id'  => 11,
                'customer_id' => 1, // Carlos Ramírez
                'rating'      => 4,
                'comment'     => 'Sofá “Nova” de muy buena calidad, llegó rápido.',
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'product_id'  => 21,
                'customer_id' => 2, // Elisa Gómez
                'rating'      => 5,
                'comment'     => '“Relax” es un sofá espectacular, amplio y cómodo.',
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'product_id'  => 23,
                'customer_id' => 8, // Javier Torres
                'rating'      => 4,
                'comment'     => 'El colchón “Nimbus” se siente premium, buena relación calidad-precio.',
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'product_id'  => 25,
                'customer_id' => 14, // Pablo Herrera
                'rating'      => 4,
                'comment'     => '“Expand” es perfecto para espacios pequeños, se adapta bien.',
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'product_id'  => 30,
                'customer_id' => 20, // Daniel Vega
                'rating'      => 5,
                'comment'     => 'El mueble TV “Classic” tiene acabado rústico muy bonito.',
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'product_id'  => 28,
                'customer_id' => 19, // Daniel Vega is #20, so let's choose #19?
                'rating'      => 5,
                'comment'     => 'La alfombra “Soft Comfort” es súper suave y cálida.',
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'product_id'  => 9,
                'customer_id' => 7, // María Sánchez
                'rating'      => 4,
                'comment'     => 'La cama “Dream” muy cómoda, aunque tardó un poco el envío.',
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            // ...
        ]);
    }
}
