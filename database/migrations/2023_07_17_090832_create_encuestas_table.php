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
        Schema::create('encuestas', function (Blueprint $table) {
            $table->id('id_encuesta');
            $table->string('nombre_encuesta');
            $table->unsignedBigInteger('id_pregunta');
            $table->unsignedBigInteger('id_cliente');
            $table->foreign('id_pregunta')->references('id_pregunta')->on('preguntas');
            $table->foreign('id_cliente')->references('id_cliente')->on('clientes');
            // otros campos de la tabla encuestas
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('encuestas');
    }
};
