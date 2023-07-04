<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Categoria;

class CategoriasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Categoria::create([
            'name' => 'Lácteos',
        ]);
        Categoria::create([
            'name' => 'Carnes y aves',
        ]);
        Categoria::create([
            'name' => 'Bebidas',
        ]);
        Categoria::create([
            'name' => 'Limpieza del hogar',
        ]);


    }
}
