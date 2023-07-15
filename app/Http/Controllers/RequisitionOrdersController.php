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
        //$solicitudCotizacion->save();

        return json_encode(['mensaje' => "registrado"]);
    }

    public function solicitudCotizacionPDF(){
        $a='hola';

        try {
            $ultimaSolicitud = SolicitudCotizacion::latest('id')->first();
            
        } catch (ModelNotFoundException $e) {
            // Manejo de la excepción si no se encuentra ningún registro
            // Por ejemplo, retornar null o un mensaje de error
            return null;
        }

       // $view = view('pdf-layouts.solicitud-cotizacion', compact('ultimaSolicitud'));

        // Carga la vista 'nombre_de_la_vista' y pasa los datos
        $pdf = PDF::loadView('pdf-layouts.solicitud-cotizacion', compact('ultimaSolicitud'));

        // Devuelve el PDF directamente en el navegador para visualización
        return $pdf->stream('nombre_del_archivo.pdf');



            // $dompdf = new Dompdf();
            // $dompdf->loadHtml($view->render());
            // $dompdf->setPaper('A4', 'portrait');
            // $dompdf->render();
            // // Establece el tipo de contenido en la respuesta para que el navegador reconozca el PDF
            // header('Content-Type: application/pdf');
            // // Devuelve el PDF directamente en el navegador con el contenido del PDF como un archivo PDF
            // $dompdf->stream("solicitud.pdf", ['Attachment' => false]);
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
