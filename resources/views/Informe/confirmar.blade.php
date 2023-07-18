@extends('dashboard')

@section('titulo','Eliminar Informe')

@section('contenido')
<div class="container">
    <h1 id="titulo" >Desea eliminar Informe</h1>
    <br>
        id Almacen: {{$informes->idalmacen}} Fecha :{{$informes->fecha}}
    <form method="POST" action="{{route('Informe.destroy',$informes->id)}}">
        @method('delete')
        @csrf
        <button class="btn btn-danger"><i class="fas fa-check-square"></i>SI</button>
        <a href="{{route('Informe.cancelar')}}" class="btn btn-primary"><i class="fas fa-times-circle"></i>NO</a>
    </form>
</div>
@endsection
