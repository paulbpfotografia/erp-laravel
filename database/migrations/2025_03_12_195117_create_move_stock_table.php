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
        Schema::create('move_stock', function (Blueprint $table) {
            $table->id();
            $table->enum('move_type', ['entrada', 'salida']);
            $table->integer('quantity');
            $table->string('reason');
            $table->timestamp('move_date');
            $table->foreignId('product_id')->constrained('products');
            $table->foreignId('order_id')->nullable()->constrained('orders');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('move_stock');
    }
};
