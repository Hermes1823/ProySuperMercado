@extends('dashboard')

@section('titulo', 'Confirmar Eliminación')

@section('contenido')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Confirmar Eliminación</h3>
        </div>
        <div class="card-body">
            <p>¿Estás seguro de que deseas eliminar la promoción?</p>
            <p><strong>ID:</strong> {{ $promocion->id_promocion }}</p>
            <p><strong>Descripción:</strong> {{ $promocion->descripcion }}</p>
            <form action="{{ route('promocion.destroy', $promocion->id_promocion) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Eliminar</button>
                <a href="{{ route('promocion.index') }}" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>
    </div>
@endsection