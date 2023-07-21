<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('detalleencuestas', function (Blueprint $table) {
            $table->unsignedInteger('id_cliente');
            $table->unsignedInteger('id_pregunta');
            $table->text('respuesta');

            $table->primary(['id_cliente', 'id_pregunta']);

            $table->foreign('id_cliente')->references('id_cliente')->on('clientes')->onDelete('cascade');
            $table->foreign('id_pregunta')->references('id_pregunta')->on('preguntas')->onDelete('cascade');

            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detalleencuestas');
    }
};
