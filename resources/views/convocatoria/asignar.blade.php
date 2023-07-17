@extends('dashboard')

@section('titulo', 'INICIO')

@section('contenido')

    <div class="card">
        <div class="card-header">
            <h3 id="titulo" class="card-title">LISTADO DE ASIGNADOS</h3>
        </div>
        <div class="card-body">

        <form action="{{route('convocatoria.asignar_store')}}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="id_postulante">Convocatoria:</label>
                    <input type="hidden" name="id_convocatoria" id="id_convocatoria" value="{{ $convocatoria->id_convocatoria }}">
                    <input type="text" value="{{ $convocatoria->descripcion }}" class="form-control" readonly>
                </div>

                <div class="form-group">
                <label for="id_postulante">Postulante:</label>
                <select name="id_postulante" id="id_postulante" class="form-control">
                    <option value="">Seleccionar postulante</option>
                    @foreach ($postulantes as $item)
                        <option value="{{ $item->id_postulante }}">{{ $item->apellidos }} {{ $item->nombre}}</option>
                    @endforeach
                </select>
                </div>

                <button type="submit" class="btn btn-primary">Asignar</button>
                <a href="{{ route('convocatoria.cancelar') }}" class="btn btn-secondary">Cancelar</a>
            </form>

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
                        <th scope="col">Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($participaciones) <= 0)
                        <tr>
                            <td colspan="4"><b>No hay registros</b></td>
                        </tr>
                    @else
                        @foreach ($participaciones as $item)
                            <tr>
                                <td>{{$item->id_participacion}}</td>
                                <td>{{ $item->postulante->apellidos }}</td>
                                <td>{{ $item->postulante->nombre }}</td>
                                <td>
                                    <a href="{{ route('convocatoria.confirmar', $item->id_convocatoria) }}" class="btn btn-danger btn-sm"><i
                                        class="fas fa-trash"></i>Eliminar</a>

                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
            {{ $participaciones->links() }}
        </div>

    </div>
@endsection