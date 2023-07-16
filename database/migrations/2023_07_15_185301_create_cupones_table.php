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
        
        Schema::create('cupones', function (Blueprint $table) {
            $table->id('id_cupon');
            $table->decimal('descuento');
            $table->date('fecha_expiracion');
            $table->string('codigo_cupon');
            $table->foreignId('id_cliente')->constrained('clientes', 'id_cliente');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cupons');
    }
};
