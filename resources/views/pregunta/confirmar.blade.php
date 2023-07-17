@extends('dashboard')

@section('titulo', 'Eliminar Pregunta')

@section('contenido')
<div class="container">
    <h1 id="titulo">¿Desea eliminar la Pregunta?</h1>
    <br>
    <p>Pregunta: {{ $pregunta->pregunta }}</p>
    
    <form method="POST" action="{{ route('pregunta.destroy', $pregunta->id_pregunta) }}">
        @method('delete')
        @csrf
        <button class="btn btn-danger"><i class="fas fa-check-square"></i> SI</button>
        <a href="{{ route('pregunta.index') }}" class="btn btn-primary"><i class="fas fa-times-circle"></i> NO</a>
    </form>
</div>
@endsection