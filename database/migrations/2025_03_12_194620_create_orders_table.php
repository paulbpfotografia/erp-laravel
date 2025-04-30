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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->date('order_date');
            $table->enum('status', ['preparado', 'pendiente', 'enviado', 'entregado', 'cancelado']);
            $table->decimal('total', 10, 2); // Importe total
            $table->decimal('total_weight', 8, 2)->nullable();
            $table->decimal('total_volume', 8, 3)->nullable();
            $table->foreignId('customer_id')->constrained('customers');
            $table->foreignId('carrier_id')->nullable()->constrained('carriers')->onDelete('set null');
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
