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
        Schema::create('almacenero', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idusuario')->nullable(); // Cambio en esta línea
            $table->unsignedBigInteger('idalmacen')->nullable();
            $table->unsignedBigInteger('idmontacarga')->nullable();
            $table->unsignedBigInteger('idproducto')->nullable();
            $table->date('fecha')->nullable();
            $table->string('detalle')->nullable();
            $table->integer('estado')->nullable();
            $table->foreign('idusuario')->references('id')->on('users');
            $table->foreign('idalmacen')->references('id')->on('almacen');
            $table->foreign('idproducto')->references('id')->on('productos');
            $table->foreign('idmontacarga')->references('id')->on('montacarga');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('almacenero');
    }
};
