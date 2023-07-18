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
            <h3 id="titulo" class="card-title">LISTADO DE ENCARGADOS DEL ALAMCEN</h3>
        </div>
        <div class="card-body">

            <a href="{{ route('Almacenero.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i>Nuevo Registro</a>


            <div id="mensaje">
                @if (session('datos'))
                    <div class="alert alert-warning alert-dismissible fade show mt-3 emergente" role="alert"
                        style="color: white; background-color: rgb(66, 183, 31)">
                        {{ session('datos') }}
                    </div>
                @endif
            </div>

            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Usuario</th>
                        <th scope="col">Almacen</th>
                        <th scope="col">Montacarga</th>
                        <th scope="col">Producto</th>
                        <th scope="col">Fecha</th>
                        <th scope="col">Detalle</th>
                        <th scope="col">Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($almaceneros) <= 0)
                        <tr>
                            <td colspan="7"><b>No hay registros</b></td>
                        </tr>
                    @else
                        @foreach ($almaceneros as $empleado)
                            <tr>
                                <td>
                                    @foreach ($usuarioss as $itemUser)
                                        @if ($itemUser->id == $empleado->idusuario)
                                            {{ $itemUser->name }}
                                            @break
                                        @endif
                                    @endforeach
                                </td>
                                <td>
                                    @foreach ($almacenes as $itemalma)
                                        @if ($itemalma->id == $empleado->idalmacen)
                                            {{ $itemalma->nombre }}
                                        @break
                                        @endif
                                    @endforeach
                                </td>
                                <td>
                                    @foreach ($montacargas as $itemmonta)
                                        @if ($itemmonta->id == $empleado->idmontacarga)
                                            {{ $itemmonta->marca }}
                                        @break
                                        @endif
                                    @endforeach
                                </td>
                                <td>
                                    @foreach ($productos as $itemproduc)
                                        @if ($itemproduc->id == $empleado->idProducto)
                                            {{ $itemproduc->nombre }}
                                        @break
                                        @endif
                                    @endforeach
                                </td>
                                <td>
                                    {{ $item->fecha }}
                                </td>
                                <td>
                                    {{ $item->detalle }}
                                </td>
                                <td>
                                    <a href="{{ route('Almacenero.edit', $item->id) }}" class="btn btn-info btn-sm"><i
                                            class="fas fa-edit"></i>Editar</a>
                                    <a href="{{ route('Almacenero.confirmar', $item->id) }}"
                                        class="btn btn-danger btn-sm"><i class="fas fa-trash"></i>Eliminar</a>

                                </td>
                            </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
        {{ $almaceneros->links() }}
    </div>

</div>
@endsection
