@extends('dashboard')

@section('titulo', 'Registro de detalle')

@section('contenido')
    <div class="container">
        <h1 id="titulo" class="card-title">REGISTRO DE DETALLE DEL ALMACEN</h1>
        <form method="POST" action="{{ route('Almacenero.store') }}">
            @csrf

            <div class="col-12 form-group">
                <label class="control-label">Usuario id</label>
                <select name="idusuario" id="idusuario"
                    class="form-control @error('idusuario') is-invalid @enderror">
                    @foreach ($usuarioss as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
                @error('idusuario')
                    <span class="invalid feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

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

            <div class="col-12 form-group">
                <label class="control-label">Montacarga id</label>
                <select name="idmontacarga" id="idmontacarga"
                    class="form-control @error('idmontacarga') is-invalid @enderror">
                    @foreach ($montacargas as $item)
                        <option value="{{ $item->id }}">{{ $item->marca }}</option>
                    @endforeach
                </select>
                @error('idmontacarga')
                    <span class="invalid feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="col-12 form-group">
                <label class="control-label">Celular</label>
                <input type="text" class="form-control @error('celular') is-invalid @enderror"
                    placeholder="Ingrese el número de celular" name="celular" required pattern="[0-9]+">
                @error('celular')
                    <span class="invalid feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="col-12 form-group">
                <label class="control-label">Sueldo</label>
                <input type="number" step="0.01" class="form-control @error('sueldo') is-invalid @enderror"
                    placeholder="Ingrese el sueldo" name="sueldo" required>
                @error('sueldo')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="col-12 form-group">
                <label class="control-label">Fecha</label>
                <input type="date" class="form-control @error('fecha') is-invalid @enderror"
                    placeholder="Ingrese la fecha" name="fecha" required>
                @error('fecha')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="col-12 form-group">
                <label class="control-label">Detalle  </label>
                <input type="text" class="form-control @error('detalle') is-invalid @enderror"
                    placeholder="Ingrese la detalle" name="detalle" >
                @error('detalle')
                    <span class="invalid feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <br>
            <button class="btn btn-primary"> <i class="fas fa-save"></i>Guardar</button>
            <a href="{{ route('Almacenero.cancelar') }}" class="btn btn-danger"> <i class="fas fa-ban"></i>Cancelar</a>
    </div>
    </form>
    </div>
        <script>
            function mensaje() {
            $('#idusuario').select2();
            $('#idalmacen').select2();
            $('#idmontacarga').select2();
            }
            setTimeout(mensaje,500);
        </script>
@endsection
