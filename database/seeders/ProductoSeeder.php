<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Producto;

class ProductoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Producto::create([
            'nombre' => 'Leche Gloria',
            'idMarca' => 1,
            'idCategoria' => 1,
            'stock' => 100,
            'photo' => '1.png'
        ]);
        Producto::create([
            'nombre' => 'Queso Gloria',
            'idMarca' => 1,
            'idCategoria' => 1,
            'stock' => 120,
            'photo' => '2.png'
        ]);

        Producto::create([
            'nombre' => 'Yogur Bonlé',
            'idMarca' => 2,
            'idCategoria' => 1,
            'stock' => 100,
            'photo' => '3.png'
        ]);
        Producto::create([
            'nombre' => 'Leche condensada Bonlé',
            'idMarca' => 2,
            'idCategoria' => 1,
            'stock' => 100,
            'photo' => '4.png'
        ]);

        Producto::create([
            'nombre' => 'Leche Laive',
            'idMarca' => 3,
            'idCategoria' => 1,
            'stock' => 100,
            'photo' => '5.png'
        ]);
        Producto::create([
            'nombre' => 'Yogur Laive',
            'idMarca' => 3,
            'idCategoria' => 1,
            'stock' => 100,
            'photo' => '6.png'
        ]);

        Producto::create([
            'nombre' => 'Carne de res La Ponderosa',
            'idMarca' => 4,
            'idCategoria' => 2,
            'stock' => 100,
            'photo' => '7.png'
        ]);
        Producto::create([
            'nombre' => 'Carne de cerdo La Ponderosa',
            'idMarca' => 4,
            'idCategoria' => 2,
            'stock' => 100,
            'photo' => '8.png'
        ]);

        Producto::create([
            'nombre' => 'Carne de res El Bodegón',
            'idMarca' => 5,
            'idCategoria' => 2,
            'stock' => 100,
            'photo' => '9.png'
        ]);
        Producto::create([
            'nombre' => 'Carne de cerdo El Bodegón',
            'idMarca' => 5,
            'idCategoria' => 2,
            'stock' => 100,
            'photo' => '10.png'
        ]);

        Producto::create([
            'nombre' => 'Pollo Rikos',
            'idMarca' => 6,
            'idCategoria' => 2,
            'stock' => 100,
            'photo' => '11.png'
        ]);
        Producto::create([
            'nombre' => 'Alitas de pollo Rikos',
            'idMarca' => 6,
            'idCategoria' => 2,
            'stock' => 100,
            'photo' => '12.png'
        ]);

        Producto::create([
            'nombre' => 'Gaseosa San Mateo',
            'idMarca' => 7,
            'idCategoria' => 3,
            'stock' => 100,
            'photo' => '13.png'
        ]);
        Producto::create([
            'nombre' => 'Agua San Mateo',
            'idMarca' => 7,
            'idCategoria' => 3,
            'stock' => 100,
            'photo' => '14.png'
        ]);

        Producto::create([
            'nombre' => 'Cerveza Cusqueña Dorada',
            'idMarca' => 8,
            'idCategoria' => 3,
            'stock' => 100,
            'photo' => '15.png'
        ]);
        Producto::create([
            'nombre' => 'Cerveza Cusqueña Negra',
            'idMarca' => 8,
            'idCategoria' => 3,
            'stock' => 100,
            'photo' => '16.png'
        ]);

        Producto::create([
            'nombre' => 'Jugo Del Valle de naranja',
            'idMarca' => 9,
            'idCategoria' => 3,
            'stock' => 100,
            'photo' => '17.png'
        ]);
        Producto::create([
            'nombre' => 'Jugo Del Valle de manzana',
            'idMarca' => 9,
            'idCategoria' => 3,
            'stock' => 100,
            'photo' => '18.png'
        ]);

        Producto::create([
            'nombre' => 'Lavavajillas Sapolio',
            'idMarca' => 10,
            'idCategoria' => 4,
            'stock' => 100,
            'photo' => '19.png'
        ]);
        Producto::create([
            'nombre' => 'Limpiador de pisos Sapolio',
            'idMarca' => 10,
            'idCategoria' => 4,
            'stock' => 100,
            'photo' => '20.png'
        ]);

        Producto::create([
            'nombre' => 'Cloro Clorox',
            'idMarca' => 11,
            'idCategoria' => 4,
            'stock' => 100,
            'photo' => '21.png'
        ]);
        Producto::create([
            'nombre' => 'Toallitas desinfectantes Clorox',
            'idMarca' => 11,
            'idCategoria' => 4,
            'stock' => 100,
            'photo' => '22.png'
        ]);

        Producto::create([
            'nombre' => 'Shampoo Suave',
            'idMarca' => 12,
            'idCategoria' => 4,
            'stock' => 100,
            'photo' => '23.png'
        ]);
        Producto::create([
            'nombre' => 'Acondicionador Suave',
            'idMarca' => 12,
            'idCategoria' => 4,
            'stock' => 100,
            'photo' => '24.png'
        ]);

    }
}
