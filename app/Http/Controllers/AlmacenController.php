<?php

namespace App\Http\Controllers;
use App\Models\Almacen;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AlmacenController extends Controller
{
    const PAGINATION=7;

    public function index(Request $request){
        $busqueda=$request->get('buscarpor');
        $almacenes=Almacen::where('nombre','like','%'.$busqueda.'%')
        ->where('estado','=','1')
        ->paginate($this::PAGINATION);
        return view('Almacen.index',compact('almacenes','busqueda'));
    }


    public function create()
    {
        if (Auth::user()->rol=='Administrativo'){   //boteon registrar

            return view('Almacen.create');
        } else{
            return redirect()->route('Almacen.index')->with('datos','..::No tiene Acceso ..::');
        }
    }
    public function store(Request $request)
    {
            $data=request()->validate(
                [
                    'nombre' => 'required|max:40',
                    'ubicacion' => 'required|max:80',
                    'capacidad' => 'required|numeric|min:0',
                ],
                [
                    'nombre.required' => 'Ingrese la marca',
                    'nombre.max' => 'Máximo 40 caracteres para la Marca',
                    'ubicacion.required' => 'Ingrese la ubicacion',
                    'ubicacion.max' => 'Máximo 80 caracteres para la ubicacion',
                    'capacidad.required' => 'Ingrese la Capacidad',
                    'capacidad.numeric' => 'Debe ser un número',
                    'capacidad.min' => 'La capacidad debe ser un número positivo',
                ]

                );
                    $almacen=new Almacen();
                    $almacen->nombre=$request->nombre;
                    $almacen->ubicacion=$request->ubicacion;
                    $almacen->capacidad=$request->capacidad;
                    $almacen->tipoalmacenamiento=$request->tipoalmacenamiento;
                    $almacen->estado='1';
                    $almacen->save();
                    return redirect()->route('Almacen.index')->with('datos','Registrados exitosamente...');
    }

    public function edit($id)
    {
        if (Auth::user()->rol=='Administrativo'){ //boton editar
            $almacen=Almacen::findOrFail($id);
            return view('Almacen.edit',compact('almacen'));
        }else{
            return redirect()->route('Almacen.index')->with('datos','..::No tiene Acceso ..::');
        }
    }

    public function update(Request $request, $id)
    {
        $data=request()->validate(
            [
                'nombre' => 'required|max:40|unique:almacen',
                'ubicacion' => 'required|max:80',
                'capacidad' => 'required|numeric|min:0',
            ],
            [
                'nombre.required' => 'Ingrese la marca',
                'nombre.max' => 'Máximo 40 caracteres para la Marca',
                'nombre.unique' => 'El nombre ya está en uso',
                'ubicacion.required' => 'Ingrese la ubicacion',
                'ubicacion.max' => 'Máximo 80 caracteres para la ubicacion',
                'capacidad.required' => 'Ingrese la Capacidad',
                'capacidad.numeric' => 'Debe ser un número',
                'capacidad.min' => 'La capacidad debe ser un número positivo',
            ]
        );
        $almacen=Almacen::findOrFail($id);
        $almacen->nombre=$request->nombre;
        $almacen->ubicacion=$request->ubicacion;
        $almacen->capacidad=$request->capacidad;
        $almacen->tipoalmacenamiento=$request->tipoalmacenamiento;
        $almacen->save();
        return redirect()->route('Almacen.index')->with('datos','Registro Actualizado exitosamente...');
    }

    public function destroy($id)
    {
            $almacen=Almacen::findOrFail($id);
            $almacen->estado='0';
            $almacen->save();
            return redirect()->route('Almacen.index')->with('datos','Registro Eliminado..');
    }


    public function confirmar($id){
        if (Auth::user()->rol=='Administrativo'){ //boton eliminar
            $almacen=Almacen::findOrFail($id);
            return view('Almacen.confirmar',compact('almacen'));
        }else{
            return redirect()->route('Almacen.index')->with('datos','..::No tiene Acceso ..::');
        }
    }


    public function cancelar(){
        return redirect()->route('Almacen.index')->with('datos','acciona cancelada...');
    }

}
