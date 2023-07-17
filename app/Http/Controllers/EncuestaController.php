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
    $clientes = Cliente::all(); // Obtener todos los clientes
    $preguntas = Pregunta::all(); // Obtener todas las preguntas

    return view('encuesta.create', compact('clientes', 'preguntas'));
}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar los campos del formulario
        $request->validate([
            'cliente_id' => 'required|exists:clientes,id_clientes',
            'respuestas.*' => 'required|string',
        ]);
    
        // Obtener el cliente y las respuestas del formulario
        $clienteId = $request->input('id_cliente');
        $respuestas = $request->input('respuestas');
    
        // Crear una nueva encuesta y guardar el cliente asociado
        $encuesta = new Encuesta();
        $encuesta->id_cliente= $clienteId;
        $encuesta->save();
    
        // Guardar las respuestas de la encuesta
        foreach ($respuestas as $respuesta) {
            // Crear una nueva respuesta y asignar la encuesta y la respuesta
            $encuestaRespuesta = new Respuesta();
            $encuestaRespuesta->id_encuesta = $encuesta->id_encuesta;
            $encuestaRespuesta->respuesta = $respuesta;
            $encuestaRespuesta->save();
        }
    
        // Redireccionar a la vista de lista de encuestas o mostrar un mensaje de éxito
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
