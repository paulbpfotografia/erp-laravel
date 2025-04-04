<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Tabla para reseñas/opiniones con relacion a Customers y a Products
     */
    public function up(): void
    {
        Schema::create('product_reviews', function (Blueprint $table) {
            $table->id();
            $table->integer('rating')->default(0); //clasificacion
            $table->text('comment')->nullable(); //Comentario
            // Relación con products
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade');
            // Relación con customers
            $table->foreignId('customer_id')->constrained('customers')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_reviews');
    }
};
