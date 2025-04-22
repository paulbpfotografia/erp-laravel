<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('product_specs', function (Blueprint $table) {
            $table->id();
            // Campos de especificaciones técnicas
            $table->decimal('weight', 8, 2)->nullable();
            $table->string('dimensions')->nullable(); // o ancho, alto, fondo separadas
            $table->decimal('packaged_volume', 8, 3)->nullable(); //Este es el volumen que ocupará embalado
            $table->string('color')->nullable();
            $table->string('material')->nullable();
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     * Tabla para las especificaciones
     */
    public function down(): void
    {
        Schema::dropIfExists('product_specs');
    }
};
