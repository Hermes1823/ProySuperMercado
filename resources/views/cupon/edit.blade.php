@extends('dashboard')

@section('titulo', 'Editar Cupón')

@section('contenido')

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Editar Cupón</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('cupon.update',  ['id' => $cupon->id_cupon]) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="descuento">Descuento (entre 0% y 100%)</label>
                    <input type="number" name="descuento" id="descuento" class="form-control" min="0" max="100" step="0.01" value="{{ $cupon->descuento }}" required>
                </div>

                <div class="form-group">
                    <label for="fecha_expiracion">Fecha de Expiración</label>
                    <input type="date" name="fecha_expiracion" id="fecha_expiracion" class="form-control" value="{{ $cupon->fecha_expiracion }}" required>
                </div>

                <div class="form-group">
                    <label for="codigo_cupon">Código de Cupón</label>
                    <input type="text" name="codigo_cupon" id="codigo_cupon" class="form-control" value="{{ $cupon->codigo_cupon }}" required>
                </div>

                <div class="form-group">
                    <label for="id_cliente">Cliente</label>
                    <select name="id_cliente" id="id_cliente" class="form-control" required>
                        @foreach ($clientes as $cliente)
                            <option value="{{ $cliente->id_cliente }}" {{ $cupon->id_cliente == $cliente->id_cliente ? 'selected' : '' }}>
                                {{ $cliente->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Guardar</button>
                <a href="{{ route('cupon.index') }}" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>
    </div>

@endsection
