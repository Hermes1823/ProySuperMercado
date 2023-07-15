
@extends('dashboard')

@section('titulo', 'Eliminar Cliente')

@section('contenido')
<div class="container">
    <h1 id="titulo">¿Desea eliminar Cliente?</h1>
    <br>
    <p>Nombre: {{$cliente->nombre}}</p>
    <p>Apellido: {{$cliente->apellido}}</p>
    <p>Teléfono: {{$cliente->telefono}}</p>
    <p>Correo Electrónico: {{$cliente->correo_electronico}}</p>
    <p>Dirección Domicilio: {{$cliente->direccion_domicilio}}</p>
    <p>Fecha de Registro: {{$cliente->fecha_registro}}</p>
    
    <form method="POST" action="{{route('cliente.destroy', $cliente->id)}}">
        @method('delete')
        @csrf
        <button class="btn btn-danger"><i class="fas fa-check-square"></i> SI</button>
        <a href="{{route('cliente.index')}}" class="btn btn-primary"><i class="fas fa-times-circle"></i> NO</a>
    </form>
</div>
@endsection