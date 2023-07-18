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
        Schema::create('preguntaencuestas', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('id_pregunta');
            $table->unsignedInteger('id_encuesta');
            $table->timestamps();

            $table->foreign('id_pregunta')->references('id_pregunta')->on('preguntas')->onDelete('cascade');
            $table->foreign('id_encuesta')->references('id_encuesta')->on('encuestas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('respuestaencuestas');
    }
};
