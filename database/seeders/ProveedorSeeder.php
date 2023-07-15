<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Proveedor;

class ProveedorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Proveedor::create([
            'ruc' => 'The Coca-Cola Company',
            'nombre' => '20415932376',
        ]);
        Proveedor::create([
            'ruc' => 'Nesté',
            'nombre' => '20263322496',
        ]);
        Proveedor::create([
            'ruc' => 'Clorox',
            'nombre' => '20264846855',
        ]);
    }
}
