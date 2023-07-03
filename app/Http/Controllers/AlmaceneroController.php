<?php

namespace App\Http\Controllers;

use App\Models\Almacen;
use App\Models\Almacenero;
use App\Models\User;
use App\Models\Montacarga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AlmaceneroController extends Controller
{
    const PAGINATION = 5;

    public function index(Request $request)
    {
        $busqueda = $request->get('buscarpor');
        $almaceneros = Almacenero::select('*')->join('users', 'users.id', '=', 'almacenero.idusuario')
            ->join('montacarga', 'montacarga.id', '=', 'almacenero.idmontacarga')
            ->join('almacen', 'almacen.id', '=', 'almacenero.idalmacen')
            ->where('almacenero.estado', '=', '1')
            ->where('users.name', 'like', '%' . $busqueda . '%')->paginate($this::PAGINATION);
            $almacenes = Almacen::all();
            $usuarioss = User::all();
            $montacargas = Montacarga::all();
        return view('Almacenero.index', compact('almaceneros','almacenes', 'usuarioss', 'montacargas', 'busqueda'));
    }

    public function create()
    {

        if (Auth::user()->rol == 0) {   //boton registrar
            $almacenes = Almacen::all();
            $usuarioss = User::all();
            $montacargas = Montacarga::all();
            return view('Almacenero.create', compact('almacenes', 'usuarioss', 'montacargas'));
        } else {
            return redirect()->route('Almacenero.index')->with('datos', '..::No tiene Acceso ..::');
        }
    }

    public function store(Request $request)
    {
        $data = request()->validate(
            [
                'celular' => 'required|min:9',
                'fecha' => 'required',
            ],
            [
                'celular.required' => 'Ingrese celular',
                'celular.min' => 'Min 9 carácteres ',
                'fecha.required' => 'Ingrese una Fecha',
            ]
        );
        $almacenero = new Almacenero();
        $almacenero->idusuario = $request->idusuario;
        $almacenero->idalmacen = $request->idalmacen;
        $almacenero->idmontacarga = $request->idmontacarga;
        $almacenero->celular = $request->celular;
        $almacenero->sueldo = $request->sueldo;
        $almacenero->fecha = $request->fecha;
        $almacenero->detalle = $request->detalle;
        $almacenero->estado = '1';
        $almacenero->save();
        return redirect()->route('Almacenero.index')->with('datos', 'Registrados exitosamente...');
    }

    public function edit($id)
    {
        if (Auth::user()->rol == 'Administrativo') { //boton editar
            $almacenero = Almacenero::findOrFail($id);
            return view('Almacenero.edit', compact('almacenero'));
        } else {
            return redirect()->route('Almacenero.index')->with('datos', '..::No tiene Acceso ..::');
        }
    }

    public function update(Request $request, $id)
    {
        $data = request()->validate(
            [
                'celular' => 'required|min:9',
                'fecha' => 'required',
            ],
            [
                'celular.required' => 'Ingrese celular',
                'celular.min' => 'Min 9 carácteres ',
                'fecha.required' => 'Ingrese una Fecha',
            ]
        );
        $almacenero = Almacenero::findOrFail($id);
        $almacenero->idusuario = $request->idusuario;
        $almacenero->idalmacen = $request->idalmacen;
        $almacenero->idmontacarga = $request->idmontacarga;
        $almacenero->celular = $request->celular;
        $almacenero->sueldo = $request->sueldo;
        $almacenero->fecha = $request->fecha;
        $almacenero->detalle = $request->detalle;
        $almacenero->save();
        return redirect()->route('Almacenero.index')->with('datos', 'Registro Actualizado exitosamente...');
    }


    public function destroy($id)
    {
            $almacenero=Almacenero::findOrFail($id);
            $almacenero->estado='0';
            $almacenero->save();
            return redirect()->route('Almacenero.index')->with('datos','Registro Eliminado..');
    }


    public function confirmar($id){
        if (Auth::user()->rol=='Administrativo'){ //boton eliminar
            $almacenero=Almacenero::findOrFail($id);
            return view('Almacenero.confirmar',compact('almacenero'));
        }else{
            return redirect()->route('Almacenero.index')->with('datos','..::No tiene Acceso ..::');
        }
    }

    public function cancelar(){
        return redirect()->route('Almacenero.index')->with('datos','acciona cancelada...');
    }

}
