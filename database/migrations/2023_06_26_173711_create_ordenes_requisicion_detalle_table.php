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
    public function up()
    {
        Schema::create('ordenes_requisicion_detalle', function (Blueprint $table) {
            $table->unsignedBigInteger('idOrdenRequisicion');
            $table->unsignedBigInteger('idProducto');
            $table->integer('cantidad')->nullable();
            $table->timestamps();
            $table->primary(['idOrdenRequisicion', 'idProducto']);
            $table->foreign('idOrdenRequisicion')->references('id')->on('ordenes_requisicion');
            $table->foreign('idProducto')->references('id')->on('productos');
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ordenes_requisicion_detalle');
    }
};
