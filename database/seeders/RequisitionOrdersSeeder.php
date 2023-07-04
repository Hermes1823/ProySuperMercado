<?php

namespace Database\Seeders;

use App\Models\RequisitionOrder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RequisitionOrdersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        RequisitionOrder::create([
            'idColaborador' => 2,
            'estado' => 'sin cotización'
        ]);
        RequisitionOrder::create([
            'idColaborador' => 2,
            'estado' => 'sin cotización'
        ]);
        
    }
}
