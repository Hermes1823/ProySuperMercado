
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
            <h3 id="titulo" class="card-title">ENCUESTAS</h3>
        </div>
        <div class="card-body">
            <div id="mensaje">
                @if (session('datos'))
                    <div class="alert alert-warning alert-dismissible fade show mt-3 emergente" role="alert"
                        style="color: white; background-color: rgb(36, 183, 31)">
                        {{ session('datos') }}
                    </div>
                @endif
            </div>

            <a href="{{ route('encuesta.create') }}" class="btn btn-primary">LLENAR ENCUESTA</a>

            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Pregunta</th>
                        <th scope="col">Respuesta</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($preguntas->isEmpty())
                        <tr>
                            <td colspan="3"><b>No hay preguntas disponibles</b></td>
                        </tr>
                    @else
                        @foreach ($preguntas as $pregunta)
                            <tr>
                                <td>{{ $pregunta->id_pregunta }}</td>
                                <td>{{ $pregunta->pregunta }}</td>
                                <td>
                                    <!-- Mostrar la respuesta correspondiente a la pregunta -->
                                    @foreach ($encuestas as $encuesta)
                                        @if ($encuesta->id_pregunta === $pregunta->id_pregunta)
                                            {{ $encuesta->respuesta }}
                                        @endif
                                    @endforeach
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>

        </div>
    </div>
@endsection
