<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $busqueda = $request->input('buscarpor');

        // Obtener todos los clientes con paginación
        $clientes = Cliente::query()
            ->where('nombre', 'LIKE', "%$busqueda%")
            ->orWhere('apellido', 'LIKE', "%$busqueda%")
            ->orWhere('telefono', 'LIKE', "%$busqueda%")
            ->orWhere('correo_electronico', 'LIKE', "%$busqueda%")
            ->orWhere('direccion_domicilio', 'LIKE', "%$busqueda%")
            ->orWhere('fecha_registro', 'LIKE', "%$busqueda%")
            ->paginate(10);

        return view('cliente.index', compact('clientes', 'busqueda'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('cliente.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'apellido' => 'required',
            // Agrega las validaciones para los demás campos del cliente aquí
            'telefono' => 'required',
            'correo_electronico' => 'required',
            'direccion_domicilio' => 'required',
            'fecha_registro' => 'required'
        ]);

        //$cliente = new Cliente();
        //$cliente->nombre = $request->nombre;
        //$cliente->apellido = $request->apellido;
        // Asigna los demás campos del cliente aquí

       // $cliente->save();

        //return redirect()->route('cliente.index')->with('success', 'Cliente creado exitosamente.');

        $cliente = new Cliente;

    $cliente->nombre = $request->input('nombre');
    $cliente->apellido = $request->input('apellido');
    $cliente->telefono = $request->input('telefono');
    $cliente->correo_electronico = $request->input('correo_electronico');
    $cliente->direccion_domicilio = $request->input('direccion_domicilio');
    $cliente->fecha_registro = $request->input('fecha_registro');
    // Asigna los valores de los otros campos según sea necesario

    $cliente->save();

    return redirect()->route('cliente.index')->with('datos', 'Cliente guardado exitosamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Cliente $cliente)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        
        $cliente = Cliente::findOrFail($id);
        return view('cliente.edit', compact('cliente'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $cliente = Cliente::findOrFail($id);

        $cliente->nombre = $request->input('nombre');
        $cliente->apellido = $request->input('apellido');
        $cliente->telefono = $request->input('telefono');
        $cliente->correo_electronico = $request->input('correo_electronico');
        $cliente->direccion_domicilio = $request->input('direccion_domicilio');
        $cliente->fecha_registro = $request->input('fecha_registro');

        $cliente->save();

        return redirect()->route('cliente.index')->with('datos', 'Cliente actualizado exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $cliente = Cliente::findOrFail($id);

        $cliente->delete();

        return redirect()->route('Cliente.index')->with('datos', 'Cliente eliminado exitosamente');   
    }

    public function confirmar($id)
    {
    if (Auth::user()->rol == 'Administrativo') {
        $cliente = Cliente::findOrFail($id);
        return view('cliente.confirmar', compact('cliente'));
    } else {
        return redirect()->route('cliente.index')->with('datos', '..:: No tiene acceso ..::');
    }
    }

    public function cancelar(){
        return redirect()->route('cliente.index')->with('datos','acciona cancelada...');
    }
}
