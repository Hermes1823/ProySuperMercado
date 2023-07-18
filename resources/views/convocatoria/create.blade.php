@extends('dashboard')

@section('titulo', 'Crear Postulante')

@section('contenido')

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Agregar Nuevo Postulante</h3>
        </div>
        <div class="card-body">
            <form action="{{route('postulante.store')}}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="apellidos">Apellidos</label>
                    <input type="text" name="apellidos" id="apellidos" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input type="text" name="nombre" id="nombre" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="telefono">Teléfono</label>
                    <input type="text" name="telefono" id="telefono" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary">Guardar</button>
                <a href="{{ route('postulante.cancelar') }}" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>
    </div>

@endsection