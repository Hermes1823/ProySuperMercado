<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Montacarga;
use App\Models\Almacen;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class MontacargaController extends Controller
{
    const PAGINATION = 4;

    public function index(Request $request)
    {
        $almacenes= Almacen::all();
        $busqueda = $request->get('buscarpor');
        $montacargas = Montacarga::where('tipomontacarga', 'like', '%' . $busqueda . '%')
            ->where('estado', '=', '1')
            ->paginate($this::PAGINATION);;
        return view('Montacarga.index', compact('montacargas', 'busqueda','almacenes'));
    }

    public function create()
    {
        if (Auth::user()->rol == 0) {   //boteon registrar
            $almacenes= Almacen::all();
            return view('Montacarga.index',compact('almacenes'));
        } else {
            return redirect()->route('Montacarga.index')->with('datos', '..::No tiene Acceso ..::');
        }
    }

    public function store(Request $request)
    {
        $data = request()->validate(
            [
                'marca' => 'required|max:40',
                'altura' => 'required|numeric|min:0',
                'capacidad' => 'required|numeric|min:0',
            ],
            [
                'marca.required' => 'Ingrese la marca',
                'marca.max' => 'Máximo 40 caracteres para la Marca',
                'altura.required' => 'Ingrese la altura',
                'altura.numeric' => 'Debe ser un número',
                'altura.min' => 'La altura debe ser un número positivo',
                'capacidad.required' => 'Ingrese la Capacidad',
                'capacidad.numeric' => 'Debe ser un número',
                'capacidad.min' => 'La capacidad debe ser un número positivo',
            ]
        );

        $montacarga = new Montacarga();
        $montacarga->marca = $request->marca;
        $montacarga->altura  = $request->altura;
        $montacarga->capacidad  = $request->capacidad;
        $montacarga->tipomontacarga  = $request->tipomontacarga;

        if ($request->hasFile('file_montacarga')) {
            $archivo = $request->file('file_montacarga')->store('ArchivosMontacarga', 'public');
            $urlFoto = Storage::url($archivo);
            $montacarga->fotomontacarga = $urlFoto;
        } else {
            $montacarga->fotomontacarga = "imagenes/Imagen_default.png";
        }
        $almacenes= Almacen::all();
        $montacarga->estado = '1';
        $montacarga->save();

        return redirect()->route('Montacarga.index')->with('datos', 'Registrados exitosamente...');
    }


    public function edit($id)
    {
        if (Auth::user()->rol == 'Persona') { //boton editar
            $montacarga = Montacarga::findOrFail($id);
            return view('Montacarga.edit', compact('montacarga'));
        } else {
            return redirect()->route('Montacarga.index')->with('datos', '..::No tiene Acceso ..::');
        }
    }
    public function update(Request $request, $id)
    {
        $data = $request->validate(
        [
            'marca' => 'required|max:40',
            'altura' => 'required|numeric|min:0',
            'capacidad' => 'required|numeric|min:0',
        ],
        [
            'marca.required' => 'Ingrese la marca',
            'marca.max' => 'Máximo 40 caracteres para la Marca',
            'altura.required' => 'Ingrese la altura',
            'altura.numeric' => 'Debe ser un número',
            'altura.min' => 'La altura debe ser un número positivo',
            'capacidad.required' => 'Ingrese la Capacidad',
            'capacidad.numeric' => 'Debe ser un número',
            'capacidad.min' => 'La capacidad debe ser un número positivo',
        ]
        );

        $montacarga = Montacarga::findOrFail($id);
        $montacarga->marca = $request->marca;
        $montacarga->altura = $request->altura;
        $montacarga->capacidad = $request->capacidad;
        $montacarga->tipomontacarga = $request->tipomontacarga;

        $imagenanterior = $montacarga->fotomontacarga;
        // imagenanterior = '/storage/ArchivosMontacarga/hXUncweljnBi0sU8Ga1c5dbkptuHvnZhCTx1DRAO.jpg';

        if ($request->hasFile('file_montacarga')) {
            $archivo = $request->file('file_montacarga')->store('ArchivosMontacarga', 'public');
            $urlFoto = Storage::url($archivo);
            $montacarga->fotomontacarga = $urlFoto;

            // Verificar si la imagen anterior es diferente a la actual
            if ($imagenanterior !== $urlFoto) {
                // Obtener la ruta de la imagen anterior
                $rutaImagenAnterior = str_replace('/storage', 'public', $imagenanterior);

                // Borrar la imagen anterior
                if (Storage::exists($rutaImagenAnterior)) {
                    Storage::delete($rutaImagenAnterior);
                }
            }
        }

        $montacarga->save();

        return redirect()->route('Montacarga.index')->with('datos', 'Registro actualizado exitosamente...');
    }



    public function destroy($id)
    {
        $montacarga = Montacarga::findOrFail($id);
        $montacarga->estado = '0';
        $montacarga->save();
        return redirect()->route('Montacarga.index')->with('datos', 'Registro Eliminado..');
    }

    public function confirmar($id)
    {
        if (Auth::user()->rol == 'Persona') { //boton eliminar
            $montacarga = Montacarga::findOrFail($id);
            return view('Montacarga.confirmar', compact('montacarga'));
        } else {
            return redirect()->route('Montacarga.index')->with('datos', '..::No tiene Acceso ..::');
        }
    }


    public function cancelar()
    {
        return redirect()->route('Montacarga.index')->with('datos', 'acciona cancelada...');
    }
}
