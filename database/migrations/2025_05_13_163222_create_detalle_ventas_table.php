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
        Schema::create('detalle_ventas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('venta_id')->constrained('ventas')->onDelete('cascade');
            $table->foreignId('producto_id')->constrained('productos');
            $table->string('producto_nombre');
            $table->decimal('producto_precio', 10, 2);
            $table->integer('cantidad');
            $table->decimal('subTotal', 10, 2);
            $table->timestamp('fecha_registro')->useCurrent();
            $table->timestamp('actualizar_registro')->useCurrentOnUpdate()->nullable();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detalle_ventas');
    }
};
