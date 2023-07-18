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
                <input type="text" placeholder="Buscar por descripción" class="form-control" value="{{ $busqueda }}"
                    name="buscarpor">
            </div>
        </form>

    </div>
@endsection
@section('contenido')

    <div class="card">
        <div class="card-header">
            <h3 id="titulo" class="card-title">LISTADO DE CONVOCATORIAS</h3>
        </div>
        <div class="card-body">

            <a href="{{route("convocatoria.create")}}" class="btn btn-primary"><i class="fas fa-plus"></i>Nuevo Registro</a>


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
                        <th scope="col">ID</th>
                        <th scope="col">Descripción</th>
                        <th scope="col">Plazas</th>
                        <th scope="col">Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($convocatorias) <= 0)
                        <tr>
                            <td colspan="4"><b>No hay registros</b></td>
                        </tr>
                    @else
                        @foreach ($convocatorias as $item)
                            <tr>
                                <td>{{$item->id_convocatoria}}</td>
                                <td>{{ $item->descripcion }}</td>
                                <td>{{ $item->plazas }}</td>
                                <td>
                                <a href="{{ route('convocatoria.asignar',$item->id_convocatoria) }}" class="btn btn-success btn-sm"><i class="fas fa-anchor"></i>Asignar</a>
                                    <a href="{{ route('convocatoria.calificar',$item->id_convocatoria) }}" class="btn btn-warning btn-sm"><i class="fas fa-align-justify"></i>Calificar</a>
                                    <a href="{{ route('convocatoria.edit',$item->id_convocatoria) }}" class="btn btn-info btn-sm"><i class="fas fa-edit"></i>Editar</a>

                                    <a href="{{ route('convocatoria.confirmar', $item->id_convocatoria) }}" class="btn btn-danger btn-sm"><i
                                            class="fas fa-trash"></i>Eliminar</a>

                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
            {{ $convocatorias->links() }}
        </div>

    </div>
@endsection