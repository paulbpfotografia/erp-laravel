<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Tabla para los detalles de productos
     */
    public function up(): void
    {
        Schema::create('product_details', function (Blueprint $table) {
            $table->id();
            $table->string('brand')->nullable(); //marca
            $table->text('shipping_info')->nullable(); //Info de envio
            $table->text('return_policy')->nullable(); //politica de devoluciones
            $table->text('warranty')->nullable(); //Garantia
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_details');
    }
};
