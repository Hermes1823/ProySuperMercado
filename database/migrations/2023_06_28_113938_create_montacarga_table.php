<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('montacarga', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('idAlmacen')->unsigned()->nullable(); // Cambio en esta línea
            $table->foreign('idAlmacen')->references('id')->on('almacen');
            $table->string('marca')->nullable();
            $table->integer('altura')->nullable();
            $table->integer('capacidad')->nullable();
            $table->string('tipomontacarga')->nullable();
            $table->longText('fotomontacarga')->nullable();
            $table->integer('estado')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('montacarga');
    }
};
