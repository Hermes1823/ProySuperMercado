<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SolicitudCotizacion;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Dompdf\Dompdf;
class SolicitudCotizacionController extends Controller
{
    //
    public function index(){
        return view ('solicitud-cotizacion.index');
    }

    public function pdf($id){

        $fechaSolicitud = SolicitudCotizacion::where('id', $id)->value('created_at')->toDateTimeString();

       

        try {
            $solicitud = SolicitudCotizacion::find($id);
            $header = SolicitudCotizacion::join('proveedores as pro', 'pro.id', '=', 'solicitudes_cotizacion.idProveedor')
            ->select('pro.nombre as nombreProveedor', 'pro.ruc as rucProveedor','solicitudes_cotizacion.created_at as fechaSolicitud')
            ->where('solicitudes_cotizacion.id', $solicitud->id)
            ->get();
            
            $productos=SolicitudCotizacion::join('ordenes_requisicion as or', 'or.id', '=', 'solicitudes_cotizacion.idOrdenRequisicion')
            ->join('ordenes_requisicion_detalle as ord','ord.idOrdenRequisicion','=','or.id')
            ->join('productos as p','p.id','=','ord.idProducto')
            ->select('p.nombre as nombreProducto','ord.cantidad')
            ->where('solicitudes_cotizacion.id', $solicitud->id)
            ->get();
            
        } catch (ModelNotFoundException $e) {
            // Manejo de la excepción si no se encuentra ningún registro
            // Por ejemplo, retornar null o un mensaje de error
            return null;
        }

            $view = view('pdf-layouts.solicitud-cotizacion', compact('header','fechaSolicitud','productos'));

            $dompdf = new Dompdf();
            $dompdf->loadHtml($view->render());
            $dompdf->setPaper('A4', 'portrait');
            $dompdf->render();
            $dompdf->stream("solicitud.pdf", ['Attachment' => false]);

    }
}
