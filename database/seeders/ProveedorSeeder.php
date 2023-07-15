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
            'nombre' => 'The Coca-Cola Company',
            'ruc' => '20415932376',
        ]);
        Proveedor::create([
            'nombre' => 'Nesté',
            'ruc' => '20263322496',
        ]);
        Proveedor::create([
            'nombre' => 'Clorox',
            'ruc' => '20264846855',
        ]);
    }
}
