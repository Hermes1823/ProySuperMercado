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
            <h3 id="titulo" class="card-title">LISTADO DE PREGUNTAS</h3>
        </div>
        <div class="card-body">

            <a href="{{ route("pregunta.create") }}" class="btn btn-primary"><i class="fas fa-plus"></i>Nueva Pregunta</a>


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
                        <th scope="col"> ID </th>
                        <th scope="col">Pregunta</th>
                        <th scope="col">Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($preguntas) <= 0)
                        <tr>
                            <td colspan="3"><b>No hay preguntas</b></td>
                        </tr>
                    @else
                        @foreach ($preguntas as $pregunta)
                            <tr>
                                <td>{{ $pregunta->id_pregunta }}</td>
                                <td>{{ $pregunta->pregunta }}</td>
                                <td>
                                    <a href="{{ route('pregunta.edit', $pregunta->id_pregunta) }}"
                                        class="btn btn-info btn-sm"><i class="fas fa-edit"></i>Editar</a>

                                    <a href="{{ route('pregunta.confirmar', $pregunta->id_pregunta) }}"
                                        class="btn btn-danger btn-sm"><i class="fas fa-trash"></i>Eliminar</a>

                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
            {{ $preguntas->links() }}
        </div>

    </div>
@endsection