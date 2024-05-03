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
        Schema::create('informe', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('idalmacen')->unsigned()->nullable(); // Cambio en esta línea
            $table->date('fecha')->nullable();
            $table->string('detalle')->nullable();
            $table->integer('estado')->nullable();
            $table->foreign('idalmacen')->references('id')->on('almacen');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('informe');
    }
};
