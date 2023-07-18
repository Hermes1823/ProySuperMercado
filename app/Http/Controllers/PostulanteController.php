<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Postulante;

class PostulanteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $busqueda = $request->input('buscarpor');
        // Obtener todos los postulantes con paginación
        $postulantes = Postulante::query()->where('apellidos', 'LIKE', "%$busqueda%")->paginate(10);
        return view('postulante.index', compact('postulantes', 'busqueda'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('postulante.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'apellidos' => 'required',
            'nombre' => 'required',
            'telefono' => 'required',
            'email' => 'required'
        ]);

        $postulante = new Postulante;

    $postulante->apellidos = $request->input('apellidos');
    $postulante->nombre = $request->input('nombre');
    $postulante->telefono = $request->input('telefono');
    $postulante->email = $request->input('email');

    $postulante->save();

    return redirect()->route('postulante.index')->with('datos', 'Postulante guardado exitosamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Postulante $postulante)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        
        $postulante = Postulante::findOrFail($id);
        return view('postulante.edit', compact('postulante'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $postulante = Postulante::findOrFail($id);

        $postulante->apellidos = $request->input('apellidos');
        $postulante->nombre = $request->input('nombre');
        $postulante->telefono = $request->input('telefono');
        $postulante->email = $request->input('email');

        $postulante->save();

        return redirect()->route('postulante.index')->with('datos', 'Postulante actualizado exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $postulante = Postulante::findOrFail($id);

        $postulante->delete();

        return redirect()->route('postulante.index')->with('datos', 'Postulante eliminado exitosamente');   
    }

    public function confirmar($id)
    {
        $postulante = Postulante::findOrFail($id);
        return view('postulante.confirmar', compact('postulante'));
    }

    public function cancelar(){
        return redirect()->route('postulante.index')->with('datos','Acción cancelada...');
    }
}
