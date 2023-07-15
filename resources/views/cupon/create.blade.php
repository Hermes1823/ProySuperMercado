@extends('dashboard')

@section('titulo', 'Crear Cupón')

@section('contenido')

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Agregar Nuevo Cupón</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('cupon.store') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="descuento">Descuento</label>
                    <input type="number" name="descuento" id="descuento" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="fecha_expiracion">Fecha de Expiración</label>
                    <input type="date" name="fecha_expiracion" id="fecha_expiracion" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="codigo_cupon">Código de Cupón</label>
                    <input type="text" name="codigo_cupon" id="codigo_cupon" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="id_cliente">Cliente</label>
                    <select name="id_cliente" id="id_cliente" class="form-control" required>
                        @foreach ($clientes as $cliente)
                            <option value="{{ $cliente->id_cliente }}">{{ $cliente->nombre }}</option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Guardar</button>
                <a href="{{ route('cupon.index') }}" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>
    </div>

@endsection
