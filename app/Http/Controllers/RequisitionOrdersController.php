<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\RequisitionOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\RequisitionOrderDetail;
use App\Models\SolicitudCotizacion;
use Illuminate\Database\QueryException;
use Dompdf\Dompdf;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use PDF;
use Carbon\Carbon;
class RequisitionOrdersController extends Controller
{
    //
    public function index(){
        return view ('requisitionorders.index');
    }

    public function create(){
        return view('requisitionorders.create');
    }

    public function register(Request $request){
        $array = $request->all();
        $idUser= Auth::user()->id;
        $cantidadElementos = count($array);
        
        //registrando en la tabla orden_requisicion
        $ordenRequisicion = new RequisitionOrder();
        $ordenRequisicion->idColaborador = $idUser;
        $ordenRequisicion->estado = "sin cotización";
        
        $ordenRequisicion->save();

        $error = ''; // Declarar la variable $error con un valor predeterminado

        for ($i = 0; $i < $cantidadElementos; $i++) {
             //registrando detalle de la orden_requisicion

        

            try {
                $orderDetailRequisition = new RequisitionOrderDetail();
                $orderDetailRequisition->idOrdenRequisicion = $ordenRequisicion->id;
                $orderDetailRequisition->idProducto = intval($array[$i]['id']);
                $orderDetailRequisition->cantidad = intval($array[$i]['cantidadComprar']);
                
                $orderDetailRequisition->save();
            } catch (\Exception $e) {
                // Manejar la excepción aquí, puedes imprimir el mensaje de error para depurar
                $error = $e->getMessage();
            }

        }
        // Retornar una respuesta en formato JSON u otro tipo de respuesta
        return json_encode(['mensaje' => $array]);

        
    }

    public function generarSolicitudCotizacion(Request $request){
        $solicitudCotizacion= new SolicitudCotizacion();
        $solicitudCotizacion->idOrdenRequisicion=$request->input('idOrdenRequisicion');
        $solicitudCotizacion->idProveedor=$request->input('idProveedor');
        $solicitudCotizacion->save();

        return json_encode(['mensaje' => "registrado"]);
    }

    public function solicitudCotizacionPDF($id){
     
        $fechaActual = Carbon::now()->format('d-m-Y');

        try {
            $ultimaCotizacion = SolicitudCotizacion::latest('id')->first();
            $header = SolicitudCotizacion::join('proveedores as pro', 'pro.id', '=', 'solicitudes_cotizacion.idProveedor')
            ->select('pro.nombre as nombreProveedor', 'pro.ruc as rucProveedor')
            ->where('solicitudes_cotizacion.id', $ultimaCotizacion->id)
            ->get();
            $productos=SolicitudCotizacion::join('ordenes_requisicion as or', 'or.id', '=', 'solicitudes_cotizacion.idOrdenRequisicion')
            ->join('ordenes_requisicion_detalle as ord','ord.idOrdenRequisicion','=','or.id')
            ->join('productos as p','p.id','=','ord.idProducto')
            ->select('p.nombre as nombreProducto','ord.cantidad')
            ->where('solicitudes_cotizacion.id', $ultimaCotizacion->id)
            ->get();
            
        } catch (ModelNotFoundException $e) {
            // Manejo de la excepción si no se encuentra ningún registro
            // Por ejemplo, retornar null o un mensaje de error
            return null;
        }

            $view = view('pdf-layouts.solicitud-cotizacion', compact('header','fechaActual','productos'));

            $dompdf = new Dompdf();
            $dompdf->loadHtml($view->render());
            $dompdf->setPaper('A4', 'portrait');
            $dompdf->render();
            $dompdf->stream("solicitud.pdf", ['Attachment' => false]);
    }



    public function show(Request $request){
             $idOrden=$request->input('id');
        
                
        try {
            $header = RequisitionOrder::select('or.id', 'colaboradores.prenombres', 'colaboradores.apellidos', 'or.estado', 'or.created_at as fecha')
            ->from('ordenes_requisicion as or')
            ->join('colaboradores', 'colaboradores.idColaborador', '=', 'or.idColaborador')
            ->where('or.id', '=', $idOrden)
            ->get();


            $details = RequisitionOrderDetail::select('p.id as idProducto','p.nombre','m.name as marca','c.name as categoria', 'ord.cantidad','p.photo')
            ->from('ordenes_requisicion_detalle as ord')
            ->join('ordenes_requisicion as or', 'or.id', '=', 'ord.idOrdenRequisicion')
            ->join('productos as p', 'p.id', '=', 'ord.idProducto')
            ->join('marcas as m', 'm.id', '=', 'p.idMarca')
            ->join('categorias as c', 'c.id', '=', 'p.idCategoria')
            ->where('or.id', '=', $idOrden)
            ->get();

        } catch (QueryException $e) {
            // Capturar y manejar la excepción
            $errorMessage = $e->getMessage();
            // Realizar acciones necesarias en caso de excepción
        }
      
           
           
    
        // Retornar una respuesta en formato JSON u otro tipo de respuesta
        return json_encode(['header' => $header , 'detail' => $details ]);



    }


    

}
