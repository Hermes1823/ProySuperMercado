<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Rols;


class RolsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
         Rols::create([
                        'rolnombre' => 'Persona',
                     ]);

         Rols::create([
                        'rolnombre' => 'Administrador'
                     ]);

    }
    //todos
    //php artisan db:seed

    //Especifico
    //php artisan db:seed --class=RolsSeeder
}
