@extends('dashboard')

@section('titulo','Eliminar Rol')

@section('contenido')
<div class="container">
    <h1 id="titulo" >Desea eliminar Rol</h1>

    <form method="POST" action="{{route('Roles.destroy',$rol->id)}}">
        @method('delete')
        @csrf
            <h4> id: {{$rol->id}} <br> Nombre :{{$rol->rolnombre}}</h4>
        <br>
        <button class="btn btn-danger"><i class="fas fa-check-square"></i>SI</button>
        <a href="{{route('Rol.cancelar')}}" class="btn btn-primary"><i class="fas fa-times-circle"></i>NO</a>
    </form>
</div>
@endsection
