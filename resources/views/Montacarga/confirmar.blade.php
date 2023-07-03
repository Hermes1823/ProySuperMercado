@extends('dashboard')

@section('titulo','Eliminar Montacarga')

@section('contenido')
<div class="container">
    <h1 id="titulo" >Desea eliminar MONTACARGA</h1>

    <form method="POST" action="{{route('Montacarga.destroy',$montacarga->id)}}">
        @method('delete')
        @csrf
            <h4> Marca: {{$montacarga->marca}} <br> Capacidad :{{$montacarga->capacidad}}</h4>
            <img id="preview" src="{{$montacarga->fotomontacarga}}"  alt="Descripción de la imagen"
            style="max-width:15%; height: auto;">
        <br>
        <button class="btn btn-danger"><i class="fas fa-check-square"></i>SI</button>
        <a href="{{route('Montacarga.cancelar')}}" class="btn btn-primary"><i class="fas fa-times-circle"></i>NO</a>
    </form>
</div>

@endsection
