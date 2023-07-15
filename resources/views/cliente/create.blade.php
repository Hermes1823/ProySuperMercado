@extends('dashboard')

@section('titulo', 'Crear Cliente')

@section('contenido')

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Agregar Nuevo Cliente</h3>
        </div>
        <div class="card-body">
            <form action="{{route('cliente.store')}}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input type="text" name="nombre" id="nombre" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="apellido">Apellido</label>
                    <input type="text" name="apellido" id="apellido" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="telefono">Teléfono</label>
                    <input type="text" name="telefono" id="telefono" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="correo_electronico">Correo Electrónico</label>
                    <input type="email" name="correo_electronico" id="correo_electronico" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="direccion_domicilio">Dirección de Domicilio</label>
                    <input type="text" name="direccion_domicilio" id="direccion_domicilio" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="fecha_registro">Fecha de Registro</label>
                    <input type="date" name="fecha_registro" id="fecha_registro" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-primary">Guardar</button>
                <a href="{{ route('cliente.index') }}" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>
    </div>

@endsection