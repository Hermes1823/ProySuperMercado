@extends('dashboard')

@section('titulo','Eliminar Almacen')

@section('contenido')
<div class="container">
    <h1 id="titulo" >Desea eliminar Almacen </h1>
    <br>
        Nombre: {{$almacen->nombre}} Capacidad :{{$almacen->capacidad}}
    <form method="POST" action="{{route('Almacen.destroy',$almacen->id)}}">
        @method('delete')
        @csrf
        <button class="btn btn-danger"><i class="fas fa-check-square"></i>SI</button>
        <a href="{{route('Almacen.cancelar')}}" class="btn btn-primary"><i class="fas fa-times-circle"></i>NO</a>
    </form>
</div>
@endsection
