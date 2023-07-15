<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SolicitudCotizacion;

class SolicitudCotizacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        SolicitudCotizacion::create([
            'idOrdenRequisicion' => 1,
            'idProveedor' => 1,
        ]);
        SolicitudCotizacion::create([
            'idOrdenRequisicion' => 1,
            'idProveedor' => 2,
        ]);
        SolicitudCotizacion::create([
            'idOrdenRequisicion' => 2,
            'idProveedor' => 1,
        ]);
        SolicitudCotizacion::create([
            'idOrdenRequisicion' => 2,
            'idProveedor' => 2,
        ]);
    }
}
