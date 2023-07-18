@extends('dashboard')

@section('titulo', 'Registro de Informes')

@section('contenido')
    <div class="container">
        <h1 id="titulo" class="card-title">REGISTRO DE INFORME</h1>
        <form method="POST" action="{{ route('Informe.store') }}">
            @csrf

            <div class="col-12 form-group">
                <label class="control-label">Almacen id</label>
                <select name="idalmacen" id="idalmacen"
                    class="form-control @error('idalmacen') is-invalid @enderror">
                    @foreach ($almacenes as $item)
                        <option value="{{ $item->id }}">{{ $item->nombre }}</option>
                    @endforeach
                </select>
                @error('idalmacen')
                    <span class="invalid feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label class="control-label">Fecha </label>
                <input type="date" class="form-control @error('fecha') is-invalid @enderror"
                    placeholder="Ingrese la fecha" name="fecha">
                @error('fecha')
                    <span class="invalid feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label class="control-label">Detalle</label>
                <input type="text" class="form-control @error('detalle') is-invalid @enderror"
                    placeholder="Ingrese la detalle" name="detalle">
                @error('detalle')
                    <span class="invalid feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div>
                <button class="btn btn-primary"> <i class="fas fa-save"></i>Generar</button>
                <a href="{{ route('Informe.cancelar') }}" class="btn btn-danger"> <i class="fas fa-ban"></i>Cancelar</a>
            </div>
        </form>
    </div>
    <script>
        setTimeout(mensaje, 500);
    </script>
@endsection
