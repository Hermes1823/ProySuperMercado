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
            <h3 id="titulo" class="card-title">LISTADO DE PROMOCIONES</h3>
        </div>

        <div class="card-body">
            <a href="{{ route('promocion.pdf') }}" class="btn btn-primary">Generar PDF</a>
            <!-- Resto del código existente para el contenido de la tabla de promociones -->
        </div>
        
        <div class="card-body">
            <a href="{{ route('promocion.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i>Nuevo Registro</a>
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
                        <th scope="col">Descripción</th>
                        <th scope="col">Fecha de Inicio</th>
                        <th scope="col">Fecha de Fin</th>
                       
                        <th scope="col">Producto</th>
                        <th scope="col">Precio Promocional</th>
                        <th scope="col">Stock de la Promocion</th>
                        <th scope="col">Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($promociones->isEmpty())
                        <tr>
                            <td colspan="7"><b>No hay registros</b></td>
                        </tr>
                    @else
                    @php
                    $stocks = [100, 20, 100, 50];
                    @endphp
                        @foreach ($promociones as $index => $promocion)
                            <tr>
                                <td>{{ $promocion->id_promocion }}</td>
                                <td>{{ $promocion->descripcion }}</td>
                                <td>{{ $promocion->fecha_inicio }}</td>
                                <td>{{ $promocion->fecha_fin }}</td>
                            
                                <td>{{ $promocion->producto->nombre }}</td>
                                <td>{{ $promocion->precio_promocional }}</td>
                                <td>{{ $stocks[$index] }}</td> 
                                <td>
                                    <a href="{{ route('promocion.edit', $promocion->id_promocion) }}"
                                        class="btn btn-info btn-sm"><i class="fas fa-edit"></i>Editar</a>
                                    <a href="{{ route('promocion.confirmar', $promocion->id_promocion) }}"
                                        class="btn btn-danger btn-sm"><i class="fas fa-trash"></i>Eliminar</a>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
            {{ $promociones->links() }}
        </div>
    </div>
@endsection
