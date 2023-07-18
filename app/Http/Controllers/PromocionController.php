<?php

namespace App\Http\Controllers;

use Dompdf\Options;
use App\Models\Promocion;
use Illuminate\Http\Request;
use App\Http\Controllers\ProductController;
use App\Models\Producto;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\App;
//use Barryvdh\DomPDF\Facade as PDF;
use Barryvdh\DomPDF\PDF;
class PromocionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
{
    $busqueda = $request->get('buscarpor');
    $promociones = Promocion::query()
        ->with('producto')
        ->where('descripcion', 'like', '%' . $busqueda . '%')
        ->orderBy('id_promocion', 'desc')
        ->paginate(10);

    return view('promocion.index', compact('promociones', 'busqueda'));
}



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $productos = Producto::all();
        return view('promocion.create', compact('productos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar los datos del formulario de creación
        $request->validate([
            'descripcion' => 'required',
            'producto' => 'required|exists:productos,id',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date',
            'precio_promocional' => 'required|numeric',
        ]);

        // Crear una nueva promoción con los datos del formulario
        Promocion::create([
            'descripcion' => $request->input('descripcion'),
            'producto_id' => $request->input('producto'),
            'fecha_inicio' => $request->input('fecha_inicio'),
            'fecha_fin' => $request->input('fecha_fin'),
            'precio_promocional' => $request->input('precio_promocional'),
        ]);

        // Redireccionar a la vista de index de promociones con un mensaje de éxito
        return redirect()->route('promocion.index')->with('datos', 'La promoción se ha creado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Promocion $promocion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Promocion $promocion)
    {
        $productos = Producto::all();
        return view('promocion.edit', compact('promocion', 'productos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Promocion $promocion)
    {
        // Validar los datos del formulario de edición
        $request->validate([
            'descripcion' => 'required',
            'producto' => 'required|exists:productos,id',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date',
            'precio_promocional' => 'required|numeric',
        ]);

        // Actualizar los datos de la promoción con los datos del formulario
        $promocion->descripcion = $request->input('descripcion');
        $promocion->producto_id = $request->input('producto');
        $promocion->fecha_inicio = $request->input('fecha_inicio');
        $promocion->fecha_fin = $request->input('fecha_fin');
        $promocion->precio_promocional = $request->input('precio_promocional');
        $promocion->save();

        // Redireccionar a la vista de index de promociones con un mensaje de éxito
        return redirect()->route('promocion.index')->with('datos', 'La promoción se ha actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function confirmar(Promocion $promocion)
    {
        return view('promocion.confirmar', compact('promocion'));
    }

    /**
     * Cancel the deletion of the specified resource.
     */
    public function cancelar()
    {
        return redirect()->route('promocion.index')->with('datos', 'Eliminación cancelada.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Promocion $promocion)
    {
        $promocion->delete();

        return redirect()->route('promocion.index')->with('datos', 'La promoción se ha eliminado correctamente.');
    }

    public function pdf()
    {
        // Obtener los datos necesarios para el reporte
        //$promociones = Promocion::all();
        //$dompdf = new PDF();
        //$dompdf->loadView('promocion.pdf',['promociones'=> $promociones]);
        //$dompdf->loadHTML('<h1>Test</h1>');
        //return $dompdf->stream();

        //return view ('promocion.pdf', compact('promociones'));

        // Cargar la vista promocion.index en una variable
        //$html = view('promocion.pdf', compact('promociones'))->render();

        // Crear una nueva instancia de Dompdf
        //$dompdf = new Dompdf();

        // Generar el PDF a partir del HTML
        //$dompdf->loadHtml($html);
        //$dompdf->render();

        // Devolver la respuesta con el PDF
        //return response($dompdf->output())
           // ->header('Content-Type', 'application/pdf');

           
    // Obtener los datos necesarios para el reporte
    $promociones = Promocion::all();

    // Configurar las opciones de Dompdf
    $options = new Options();
    $options->set('defaultFont', 'Arial');

    // Crear una instancia de Dompdf
    $dompdf = new Dompdf($options);

    // Cargar la vista promocion.pdf en una variable
    $html = view('promocion.pdf', compact('promociones'))->render();

    // Cargar el HTML en Dompdf
    $dompdf->loadHtml($html);

    // Renderizar el PDF
    $dompdf->render();

    // Devolver la respuesta con el PDF
    return $dompdf->stream('promocion.pdf');


    }
}
