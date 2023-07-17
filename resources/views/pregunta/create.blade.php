@extends('dashboard')

@section('titulo', 'Crear Pregunta')

@section('contenido')

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Agregar Nueva Pregunta</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('pregunta.store') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="pregunta">Pregunta</label>
                    <input type="text" name="pregunta" id="pregunta" class="form-control" required>
                </div>

                <!-- Agrega aquí el resto de los campos de la pregunta... -->

                <button type="submit" class="btn btn-primary">Guardar Pregunta</button>
                <a href="{{ route('pregunta.index') }}" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>
    </div>

@endsection