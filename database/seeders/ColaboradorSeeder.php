<?php

namespace Database\Seeders;

use App\Models\Colaborador;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ColaboradorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Colaborador::create([
            'idColaborador' => 2,
            'prenombres' => 'Estrella',
            'apellidos' => 'Cruz Ulloa',
            'direccion' => 'Av. Las Palmeras 121',
            'ciudad' => 'Trujillo',
            'pais' => 'Perú',
            'codigoPostal' => '13001',
            'fechaNacimiento' => '12-10-2000',
            'descripcion' => 'Proactiva y responsable',
        ]);

        Colaborador::create([
            'idColaborador' => 3,
            'prenombres' => 'HERMES',
            'apellidos' => 'CASTILLO SARMIENTO',
            'direccion' => 'Av. Las Palmeras 121',
            'ciudad' => 'Trujillo',
            'pais' => 'Perú',
            'codigoPostal' => '13001',
            'fechaNacimiento' => '12-10-2000',
            'descripcion' => 'Proactiva y responsable',
        ]);

     

    }
}
