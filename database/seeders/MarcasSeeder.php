<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Marca;

class MarcasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Marca::create([
            'name' => 'Gloria',
        ]);
        Marca::create([
            'name' => 'Bonlé',
        ]);
        Marca::create([
            'name' => 'Laive',
        ]);
        
        Marca::create([
            'name' => 'La Ponderosa',
        ]);
        Marca::create([
            'name' => 'El Bodegón',
        ]);
        Marca::create([
            'name' => 'Rikos',
        ]);

        Marca::create([
            'name' => 'San Mateo',
        ]);
        Marca::create([
            'name' => 'Cusqueña',
        ]);
        Marca::create([
            'name' => 'Del Valle',
        ]);

        Marca::create([
            'name' => 'Sapolio',
        ]);
        Marca::create([
            'name' => 'Clorox',
        ]);
        Marca::create([
            'name' => 'Suave',
        ]);

    }
}
