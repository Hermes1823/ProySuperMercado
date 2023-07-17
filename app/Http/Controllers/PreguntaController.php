<?php

namespace App\Http\Controllers;

use App\Models\Pregunta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PreguntaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $busqueda = $request->input('buscarpor');

        $preguntas = Pregunta::when($busqueda, function ($query, $busqueda) {
            return $query->where('pregunta', 'LIKE', '%' . $busqueda . '%');
        })->paginate(10);

        return view('pregunta.index', compact('preguntas', 'busqueda'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pregunta.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'pregunta' => 'required',
            
        ]);

        $pregunta = new Pregunta;

        $pregunta->pregunta = $request->input('pregunta');
        

        $pregunta->save();

        return redirect()->route('pregunta.index')->with('datos', 'Pregunta guardada exitosamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pregunta $pregunta)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $pregunta = Pregunta::findOrFail($id);
        return view('pregunta.edit', compact('pregunta'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $pregunta = Pregunta::findOrFail($id);

        $pregunta->pregunta = $request->input('pregunta');
        // Asigna los valores de los otros campos de la pregunta según sea necesario

        $pregunta->save();

        return redirect()->route('pregunta.index')->with('datos', 'Pregunta actualizada exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $pregunta = Pregunta::findOrFail($id);

        $pregunta->delete();

        return redirect()->route('pregunta.index')->with('datos', 'Pregunta eliminada exitosamente');
    }
    public function confirmar($id)
    {
        if (Auth::user()->rol == 'Administrador') {
            $pregunta = Pregunta::findOrFail($id);
            return view('pregunta.confirmar', compact('pregunta'));
        } else {
            return redirect()->route('pregunta.index')->with('datos', '..:: No tiene acceso ..::');
        }
    }

    public function cancelar()
    {
        return redirect()->route('pregunta.index')->with('datos', 'Acción cancelada...');
    }
}
