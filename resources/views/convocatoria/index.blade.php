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
                <input type="text" placeholder="Buscar por apellidos" class="form-control" value="{{ $busqueda }}"
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

            <a href="{{route("postulante.create")}}" class="btn btn-primary"><i class="fas fa-plus"></i>Nuevo Registro</a>


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
                        <th scope="col">Apellidos</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Telefono</th>
                        <th scope="col">Email</th>
                        <th scope="col">Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($postulantes) <= 0)
                        <tr>
                            <td colspan="6"><b>No hay registros</b></td>
                        </tr>
                    @else
                        @foreach ($postulantes as $item)
                            <tr>
                                <td>{{$item->id_postulante}}</td>
                                <td>{{ $item->apellidos }}</td>
                                <td>{{ $item->nombre }}</td>
                                <td>{{ $item->telefono}}</td>
                                <td>{{ $item->email}}</td>
                                <td>
                                    <a href="{{ route('postulante.edit',$item->id_postulante) }}" class="btn btn-info btn-sm"><i class="fas fa-edit"></i>Editar</a>

                                    <a href="{{ route('postulante.confirmar', $item->id_postulante) }}" class="btn btn-danger btn-sm"><i
                                            class="fas fa-trash"></i>Eliminar</a>

                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
            {{ $postulantes->links() }}
        </div>

    </div>
@endsection