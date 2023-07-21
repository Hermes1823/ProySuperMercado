@extends('dashboard')

@section('titulo', 'INICIO')
@section('buscar')
    <div class="collapse" id="search-nav">
        <form class="navbar-left navbar-form nav-search mr-md-3" method="GET" role="search">
            <div class="input-group">
                <div class="input-group-prepend">
                    <button type="submit" class="btn btn-search pr-1">
                        <i class="fa fa-search search-icon"></i>
                    </button>
                </div>
                <input type="text" placeholder="Buscar por nombre" class="form-control" value="{{ $busqueda }}"
                    name="buscarpor">
            </div>
        </form>
    </div>
@endsection

@section('contenido')
    <div class="card">
        <div class="card-header">
            <h3 id="titulo" class="card-title">LISTADO DE DETALLE DE ENCUESTAS</h3>
        </div>
        <div class="card-body">
            <a href="{{ route('detalleencuesta.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Nuevo Registro
            </a>

            <div id="mensaje">
                @if (session('datos'))
                    <div class="alert alert-warning alert-dismissible fade show mt-3 emergente" role="alert"
                        style="color: white; background-color: rgb(36, 183, 31)">
                        {{ session('datos') }}
                    </div>
                @endif
            </div>

            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">ID Cliente</th>
                        <th scope="col">ID Pregunta</th>
                        <th scope="col">Respuesta</th>
                        <th scope="col">Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($detalleEncuestas) <= 0)
                        <tr>
                            <td colspan="4"><b>No hay registros</b></td>
                        </tr>
                    @else
                        @foreach ($detalleEncuestas as $detalleEncuesta)
                            <tr>
                                <td>{{ $detalleEncuesta->id_cliente }}</td>
                                <td>{{ $detalleEncuesta->id_pregunta }}</td>
                                <td>{{ $detalleEncuesta->respuesta }}</td>
                                
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
            {{ $detalleEncuestas->links() }}
        </div>
    </div>
@endsection
