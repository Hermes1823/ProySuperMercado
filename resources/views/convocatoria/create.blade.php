@extends('dashboard')

@section('titulo', 'Crear Convocatoria')

@section('contenido')

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Agregar Nueva Convocatoria</h3>
        </div>
        <div class="card-body">
            <form action="{{route('convocatoria.store')}}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="descripcion">Descripción</label>
                    <input type="text" name="descripcion" id="descripcion" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="plazas">Plazas</label>
                    <input type="number" name="plazas" id="plazas" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-primary">Guardar</button>
                <a href="{{ route('convocatoria.cancelar') }}" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>
    </div>

@endsection