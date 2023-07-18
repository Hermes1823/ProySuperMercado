<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Convocatoria;
use App\Models\Participacion;
use App\Models\Postulante;
use App\Models\Examen;

class ConvocatoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $busqueda = $request->input('buscarpor');
        $convocatorias = Convocatoria::query()->where('descripcion', 'LIKE', "%$busqueda%")->paginate(10);
        return view('convocatoria.index', compact('convocatorias', 'busqueda'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('convocatoria.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'descripcion' => 'required',
            'plazas' => 'required'
        ]);

        $convocatoria = new Convocatoria;

    $convocatoria->descripcion = $request->input('descripcion');
    $convocatoria->plazas = $request->input('plazas');

    $convocatoria->save();

    return redirect()->route('convocatoria.index')->with('datos', 'Convocatoria guardado exitosamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Convocatoria $convocatoria)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        
        $convocatoria = Convocatoria::findOrFail($id);
        return view('convocatoria.edit', compact('convocatoria'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $convocatoria = Convocatoria::findOrFail($id);

        $convocatoria->descripcion = $request->input('descripcion');
        $convocatoria->plazas = $request->input('plazas');

        $convocatoria->save();

        return redirect()->route('convocatoria.index')->with('datos', 'Convocatoria actualizado exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $convocatoria = Convocatoria::findOrFail($id);

        $convocatoria->delete();

        return redirect()->route('convocatoria.index')->with('datos', 'Convocatoria eliminado exitosamente');   
    }

    public function confirmar($id)
    {
        $convocatoria = Convocatoria::findOrFail($id);
        return view('convocatoria.confirmar', compact('convocatoria'));
    }

    public function cancelar(){
        return redirect()->route('convocatoria.index')->with('datos','Acción cancelada...');
    }

    public function asignar($id){
        $convocatoria = Convocatoria::findOrFail($id);
        $postulantes = Postulante::get();
        $participaciones = Participacion::query()->where('id_convocatoria', '=', $id)->paginate(10);
        return view('convocatoria.asignar', compact('convocatoria','postulantes','participaciones'));
    }

    public function asignar_store(Request $request){
        $participacion = new Participacion();
        $participacion->id_postulante = $request->input('id_postulante');
        $participacion->id_convocatoria = $request->input('id_convocatoria');
        $examen = new Examen();
        $examen->save();
        $participacion->id_examen = $examen->id;
        $participacion->save();
        $id = Convocatoria::findOrFail($request->input('id_convocatoria'));
        return redirect()->route('convocatoria.asignar', $id)->with('datos', 'Convocatoria guardada exitosamente');
    }

    public function calificar($id){
        $convocatoria = Convocatoria::findOrFail($id);
        $postulantes = Postulante::get();
        $participaciones = Participacion::query()->where('id_convocatoria', '=', $id)->paginate(10);
        return view('convocatoria.asginar', compact('convocatoria','postulantes','participaciones'));
    }
}
