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
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre')->nullable();
            $table->unsignedBigInteger('idMarca');
            $table->unsignedBigInteger('idCategoria');
            $table->string('descripcion',255)->nullable();
            $table->integer('stock')->nullable();
            $table->string('photo')->nullable();
            $table->timestamps();
            $table->foreign('idMarca')->references('id')->on('marcas');
            $table->foreign('idCategoria')->references('id')->on('categorias');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};
