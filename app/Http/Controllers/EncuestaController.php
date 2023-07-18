<?php

namespace App\Http\Controllers;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\PreguntaController;
use App\Models\Encuesta;
use App\Models\Pregunta;
use App\Models\Cliente;
use App\Models\Respuesta;
use Illuminate\Http\Request;

class EncuestaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
{
    $busqueda = $request->input('buscarpor');
    
    $encuestas = Encuesta::query()
        ->where('nombre_encuesta', 'LIKE', "%$busqueda%")
        //->orWhere('campo2', 'LIKE', "%$busqueda%")
        //->orWhere('campo3', 'LIKE', "%$busqueda%")
        ->paginate(10);
        $preguntas = Pregunta::all();
        $clientes = Cliente::all();

    return view('encuesta.index', compact('encuestas', 'busqueda','clientes','preguntas'));
}

    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clientes = Cliente::all();
        $preguntas = Pregunta::all();

        return view('encuesta.create', compact('clientes', 'preguntas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $request->validate([
        'id_cliente' => 'required|exists:clientes,id_cliente',
        'nombre_encuesta' => 'required|string',
        'preguntas' => 'required|array',
        'preguntas.*' => 'exists:preguntas,id_pregunta',
        'respuestas' => 'required|array',
        'respuestas.*' => 'required|string',
    ]);

    $encuesta = new Encuesta();
    $encuesta->id_cliente = $request->input('id_cliente');
    $encuesta->nombre_encuesta = $request->input('nombre_encuesta');
    $encuesta->save();

    $preguntas = $request->input('preguntas');
    $respuestas = $request->input('respuestas');

    foreach ($preguntas as $key => $preguntaId) {
        $encuesta->preguntas()->attach($preguntaId, ['respuesta' => $respuestas[$key]]);
    }

    return redirect()->route('encuesta.index')->with('datos', 'Encuesta guardada exitosamente.');

}
    /**
     * Display the specified resource.
     */
    public function show(Encuesta $encuesta)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Encuesta $encuesta)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Encuesta $encuesta)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Encuesta $encuesta)
    {
        //
    }
}
