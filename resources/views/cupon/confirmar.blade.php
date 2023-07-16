@extends('dashboard')

@section('titulo', 'Eliminar Cupón')

@section('contenido')
<div class="container">
    <h1 id="titulo">¿Desea eliminar Cupón?</h1>
    <br>
    <p>Descuento: {{ $cupon->descuento }}</p>
    <p>Fecha de Expiración: {{ $cupon->fecha_expiracion }}</p>
    <p>Código de Cupón: {{ $cupon->codigo_cupon }}</p>
    <p>Cliente: {{ $cupon->cliente->nombre }}</p>
    
    <form method="POST" action="{{ route('cupon.destroy', $cupon->id) }}">
        @method('DELETE')
        @csrf
        <button class="btn btn-danger"><i class="fas fa-check-square"></i> SI</button>
        <a href="{{ route('cupon.index') }}" class="btn btn-primary"><i class="fas fa-times-circle"></i> NO</a>
    </form>
</div>
@endsection