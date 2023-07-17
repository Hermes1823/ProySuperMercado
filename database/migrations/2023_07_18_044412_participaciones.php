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
        Schema::create('participaciones', function (Blueprint $table) {
            $table->id('id_participacion');
            $table->integer('id_postulante')->nullable();
            $table->integer('id_convocatoria')->nullable();
            $table->integer('id_examen')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('participaciones');
    }
};
