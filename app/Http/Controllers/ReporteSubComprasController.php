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

           

        //$productos= DB::select('CALL reporteStocksProductos()');

        $puntos = [];
        foreach ($solicitudes as $solicitud) {
           $puntos[] = ['name' => $solicitud->estado,'y' => floatval($solicitud->cantidad)];
        }

        //obtener fecha actual
        Carbon::setLocale('es');

        // Obtener la fecha actual en formato de palabras y números
        $fecha_actual = Carbon::now()->isoFormat('dddd DD [de] MMMM [del] YYYY');

        return view ("reportes-subcompras.reportes-subcompras", ["data" => json_encode($puntos)],compact('fecha_actual'));

    }
}
