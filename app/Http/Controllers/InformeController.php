<?php

namespace App\Http\Controllers;
use App\Models\Informe;
use App\Models\Almacen;
use App\Models\Montacarga;
use App\Models\Almacenero;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\PDF; //use PDF
use Illuminate\Http\Request;

class InformeController extends Controller
{
    const PAGINATION=7;
    public function index(Request $request){
        $busqueda=$request->get('buscarpor');
        $informes=Informe::where('idalmacen','like','%'.$busqueda.'%')
        ->where('estado','=','1')
        ->paginate($this::PAGINATION);

        $almacenes = Almacen::all();
        return view('Informe.index',compact('informes','busqueda','almacenes'));
    }

    public function create()
    {
        if (Auth::user()->rol==0){   //boton registrar
            $almacenes = Almacen::all();
            return view('Informe.create',compact('almacenes'));
        } else{
            return redirect()->route('Informe.index')->with('datos','..::No tiene Acceso ..::');
        }
    }


    public function store(Request $request)
    {
                    $informes=new Informe();
                    $informes->idalmacen=$request->idalmacen;
                    $informes->fecha=$request->fecha;
                    $informes->detalle=$request->detalle;
                    $informes->estado='1';
                    $informes->save();

                    $montacarD=Montacarga::all();

                    $almacenes=Almacen::all();
                    $almacenD=Almacenero::where('idalmacen','=',$request->idalmacen)->paginate();
                    $pdf = PDF::loadView('Informe.pdf',['almacenD'=>$almacenD,'montacarD'=>$montacarD,'almacenes'=>$almacenes]);
                    return $pdf->stream();
    }


    public function destroy($id)
    {
            $informes=Informe::findOrFail($id);
            $informes->estado='0';
            $informes->save();
            return redirect()->route('Informe.index')->with('datos','Registro Eliminado..');
    }

    public function confirmar($id){
        if (Auth::user()->rol=='Administrativo'){ //boton eliminar
            $informes=Informe::findOrFail($id);
            return view('Informe.confirmar',compact('informes'));
        }else{
            return redirect()->route('Informe.index')->with('datos','..::No tiene Acceso ..::');
        }
    }

    public function cancelar(){
        return redirect()->route('Informe.index')->with('datos','acciona cancelada...');
    }










}
