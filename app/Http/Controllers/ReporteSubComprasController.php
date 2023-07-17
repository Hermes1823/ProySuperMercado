<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
class ReporteSubComprasController extends Controller
{
    //
    public function reportes(){
        $solicitudes= DB::select('select sc.estado as estado,
            count(sc.estado) as cantidad   
            from solicitudes_cotizacion as sc
            group by sc.estado');

        $productos_marcas= DB::select ('SELECT m.name as marca, 
        COUNT(p."idMarca") as cantidad
        FROM productos AS p
        INNER JOIN marcas AS m ON p."idMarca" = m."id"
        GROUP BY m.name,m.id
        ORDER BY m."id" ASC');

        $marcas= DB::select('select m.name from marcas as m');

       

        //$productos= DB::select('CALL reporteStocksProductos()');

        $puntos = [];
        $puntos1=[];
        $puntos11=[];
        foreach ($solicitudes as $solicitud) {
           $puntos[] = ['name' => $solicitud->estado,'y' => floatval($solicitud->cantidad)];
        }
        foreach ($productos_marcas as $pm) {
            $puntos1[] = floatval($pm->cantidad);
            $puntos11[]= $pm->marca;
         }


        
         return view('reportes-subcompras.reportes-subcompras', [
            'data' => json_encode($puntos),
            'data2' => json_encode($puntos11),
            'data1' => json_encode($puntos1),
        ]);

    }
}
