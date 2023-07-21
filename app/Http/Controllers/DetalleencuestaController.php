<?php

namespace App\Http\Controllers;

use App\Models\Detalleencuesta;
use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\Pregunta;

class DetalleencuestaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $busqueda = $request->input('buscarpor', ''); // Obtener el valor del campo de búsqueda

        // Obtener los detalles de encuesta que coincidan con la búsqueda
        $detalleEncuestas = DetalleEncuesta::where(function ($query) use ($busqueda) {
            $query->where('id_cliente', 'LIKE', '%' . $busqueda . '%')
                ->orWhere('id_pregunta', 'LIKE', '%' . $busqueda . '%')
                ->orWhere('respuesta', 'LIKE', '%' . $busqueda . '%');
        })->paginate(10);

        return view('detalleencuesta.index', compact('detalleEncuestas', 'busqueda'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clientes = Cliente::all(); // Obtener todos los clientes
        $preguntas = Pregunta::all(); // Obtener todas las preguntas

        return view('detalleencuesta.create', compact('clientes', 'preguntas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_cliente' => 'required|exists:clientes,id_cliente',
            'preguntas' => 'required|array',
            'preguntas.*' => 'exists:preguntas,id_pregunta',
            'respuestas' => 'required|array',
            'respuestas.*' => 'required|string',
        ]);

        $id_cliente = $request->input('id_cliente');
        $preguntas = $request->input('preguntas');
        $respuestas = $request->input('respuestas');

        foreach ($preguntas as $preguntaId) {
            DetalleEncuesta::create([
                'id_cliente' => $id_cliente,
                'id_pregunta' => $preguntaId,
                'respuesta' => $respuestas[$preguntaId],
            ]);
        }

        return redirect()->route('detalleencuesta.index')->with('datos', 'Detalle de encuesta guardado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Detalleencuesta $detalleencuesta)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Detalleencuesta $detalleencuesta)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Detalleencuesta $detalleencuesta)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Detalleencuesta $detalleencuesta)
    {
        //
    }
}