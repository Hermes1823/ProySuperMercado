<?php

namespace App\Http\Controllers;

use App\Models\Cupon;
use Illuminate\Http\Request;

class CuponController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
{
    $busqueda = $request->input('buscarpor');

    // Obtener todos los cupones con paginación
    $cupones = Cupon::query()
        ->where('descuento', 'LIKE', "%$busqueda%")
        ->orWhere('fecha_expiracion', 'LIKE', "%$busqueda%")
        ->orWhere('codigo_cupon', 'LIKE', "%$busqueda%")
        ->paginate(10);

    return view('cupon.index', compact('cupones', 'busqueda'));
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('cupon.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $request->validate([
        'descuento' => 'required',
        'fecha_expiracion' => 'required',
        'codigo_cupon' => 'required',
        'id_cliente' => 'required'
        // Agrega las validaciones para los demás campos del cupón aquí
    ]);

    $cupon = new Cupon;

    $cupon->descuento = $request->input('descuento');
    $cupon->fecha_expiracion = $request->input('fecha_expiracion');
    $cupon->codigo_cupon = $request->input('codigo_cupon');
    $cupon->id_cliente = $request->input('id_cliente');
    // Asigna los valores de los otros campos según sea necesario

    $cupon->save();

    return redirect()->route('cupon.index')->with('datos', 'Cupón guardado exitosamente');
}


    /**
     * Display the specified resource.
     */
    public function show(Cupon $cupon)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cupon $cupon)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cupon $cupon)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cupon $cupon)
    {
        //
    }
}
