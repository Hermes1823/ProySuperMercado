<?php

namespace Database\Seeders;
use App\Models\RequisitionOrderDetail;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class RequisitionOrdersDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        RequisitionOrderDetail::create([
            'idOrdenRequisicion' => 1,
            'idProducto' => 1,
            'cantidad' => 20
        ]);
        RequisitionOrderDetail::create([
            'idOrdenRequisicion' => 1,
            'idProducto' => 2,
            'cantidad' => 20
        ]);

        RequisitionOrderDetail::create([
            'idOrdenRequisicion' => 2,
            'idProducto' => 2,
            'cantidad' => 40
        ]);
        RequisitionOrderDetail::create([
            'idOrdenRequisicion' => 2,
            'idProducto' => 3,
            'cantidad' => 100
        ]);

    }
}
