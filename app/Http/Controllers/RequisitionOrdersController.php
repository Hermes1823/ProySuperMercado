<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\RequisitionOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\RequisitionOrderDetail;
use Illuminate\Database\QueryException;



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
        return json_encode(['mensaje' => $error]);
        
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
