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
            $table->integer('idAlmacen')->nullable();
            $table->string('marca')->nullable();
            $table->integer('altura')->nullable();
            $table->integer('capacidad')->nullable();
            $table->string('tipomontacarga')->nullable();
            $table->longText('fotomontacarga')->nullable();
            $table->integer('estado')->nullable();
            $table->foreign('idAlmacen')->references('id')->on('almacen');
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
