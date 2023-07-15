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
        Schema::create('solicitudes_cotizacion', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idOrdenRequisicion');
            $table->unsignedBigInteger('idProveedor');
            $table->timestamps();
            $table->foreign('idOrdenRequisicion')->references('id')->on('ordenes_requisicion');
            $table->foreign('idProveedor')->references('id')->on('proveedores');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('solicitudes_cotizacion');
    }
};
