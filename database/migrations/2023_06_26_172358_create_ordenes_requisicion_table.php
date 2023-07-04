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
        Schema::create('ordenes_requisicion', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idColaborador');
            $table->string('estado');
            $table->timestamps();
            $table->foreign('idColaborador')->references('idColaborador')->on('colaboradores');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ordenes_requisicion');
    }
};
