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
            $table->integer('idusuario')->nullable();
            $table->integer('idalmacen')->nullable();
            $table->integer('idmontacarga')->nullable();
            $table->string('celular')->nullable();
            $table->float('sueldo')->nullable();
            $table->date('fecha')->nullable();
            $table->string('detalle')->nullable();
            $table->integer('estado')->nullable();
            $table->foreign('idusuario')->references('id')->on('users');
            $table->foreign('idalmacen')->references('id')->on('almacen');
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
