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
        Schema::create('respuestas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_encuesta')->constrained('encuestas', 'id_encuesta')->onDelete('cascade');
            $table->foreignId('id_pregunta')->nullable()->constrained('preguntas', 'id_pregunta')->onDelete('set null');
            $table->foreignId('id_cliente')->constrained('clientes','id_cliente')->onDelete('cascade');
            $table->text('respuesta');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('respuestas');
    }
};
