<?php

namespace App\Http\Controllers;
use App\Models\Cliente;
use App\Models\Cupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;



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
        $clientes = Cliente::all();
        return view('cupon.create', ['clientes' => $clientes]);
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
    public function edit($id)
    {
        $cupon = Cupon::findOrFail($id); 
        $clientes = Cliente::all(); 
        
        return view('cupon.edit', compact('cupon', 'clientes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
{
    $cupon = Cupon::findOrFail($id); // Obtén el cupón a actualizar por su ID

    // Validar los datos del formulario
    $request->validate([
        'descuento' => 'required|numeric|min:0|max:1',
        'fecha_expiracion' => 'required|date',
        'codigo_cupon' => 'required',
        'id_cliente' => 'required|exists:clientes,id_cliente'
    ]);

    // Actualizar los valores del cupón
    $cupon->descuento = $request->descuento;
    $cupon->fecha_expiracion = $request->fecha_expiracion;
    $cupon->codigo_cupon = $request->codigo_cupon;
    $cupon->id_cliente = $request->id_cliente;
    $cupon->save();

    // Redirigir a la vista de detalles del cupón actualizado
    return redirect()->route('cupon.index', $cupon->id)->with('success', 'Cupón actualizado exitosamente');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $cupon = Cupon::findOrFail($id); // Obtén el cupón a eliminar por su ID
    
        $cupon->delete(); // Eliminar el cupón
    
        // Redirigir a la vista de índice de cupones con un mensaje de éxito
        return redirect()->route('cupon.index')->with('success', 'Cupón eliminado exitosamente');
    }

    public function confirmar($id)
{
    if (Auth::user()->rol == 'Administrador') {
        $cupon = Cupon::findOrFail($id);
        return view('cupon.confirmar', compact('cupon'));
    } else {
        return redirect()->route('cupon.index')->with('datos', '..:: No tiene acceso ..::');
    }
}

public function cancelar()
{
    return redirect()->route('cupon.index')->with('datos', 'Acción cancelada...');
}
}
