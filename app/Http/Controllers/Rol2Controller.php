<?php

namespace App\Http\Controllers;
use App\Models\Rols;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class Rol2Controller extends Controller
{
    const PAGINATION = 4;

    public function index(Request $request)
    {
        $busqueda = $request->get('buscarpor');
        $roles = Rols::where('rolnombre', 'like', '%' . $busqueda . '%')
            ->where('estado', '=', '1')
            ->paginate($this::PAGINATION);;
        return view('Rols.index', compact('roles', 'busqueda'));
    }

    public function create()
    {
        if (Auth::user()->rol == 'Persona') {   //boteon registrar

            return view('Rols.index');
        } else {
            return redirect()->route('Roles.index')->with('datos', '..::No tiene Acceso ..::');
        }
    }

    public function store(Request $request)
    {
            $data=request()->validate(
                [
                    'rolnombre' => 'required|max:50',
                ],
                [
                    'rolnombre.required' => 'Ingrese la marca',
                    'rolnombre.max' => 'Máximo 40 caracteres para la Marca',
                ]
                );
                    $rol=new Rols();
                    $rol->rolnombre=$request->rolnombre;
                    $rol->estado='1';
                    $rol->save();
                    return redirect()->route('Roles.index')->with('datos','Registrados exitosamente...');
    }

    public function edit($id)
    {
        if (Auth::user()->rol=='Persona'){ //boton editar
            $rol=Rols::findOrFail($id);
            return view('Rols.edit',compact('rol'));
        }else{
            return redirect()->route('Roles.index')->with('datos','..::No tiene Acceso ..::');
        }
    }

    public function update(Request $request, $id)
    {
        $data=request()->validate(
            [
                'rolnombre' => 'required|max:50',
            ],
            [
                'rolnombre.required' => 'Ingrese la marca',
                'rolnombre.max' => 'Máximo 40 caracteres para la Marca',
            ]
            );
            $rol=new Rols();
            $rol->rolnombre=$request->rolnombre;
            $rol->estado='1';
            $rol->save();
        return redirect()->route('Roles.index')->with('datos','Registro Actualizado exitosamente...');
    }

    public function destroy($id)
    {
            $rol=Rols::findOrFail($id);
            $rol->estado='0';
            $rol->save();
            return redirect()->route('Roles.index')->with('datos','Registro Eliminado..');
    }
    public function confirmar($id){
        if (Auth::user()->rol=='Administrativo'){ //boton eliminar
            $rol=Rols::findOrFail($id);
            return view('Rols.confirmar',compact('rol'));
        }else{
            return redirect()->route('Roles.index')->with('datos','..::No tiene Acceso ..::');
        }
    }


    public function cancelar(){
        return redirect()->route('Roles.index')->with('datos','acciona cancelada...');
    }
}
