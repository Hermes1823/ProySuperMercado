@extends('dashboard')

@section('titulo', 'Crear Detalle de Encuesta')

@section('contenido')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Crear Detalle de Encuesta</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('detalleencuesta.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="id_cliente">Cliente:</label>
                    <select class="form-control" id="id_cliente" name="id_cliente" required>
                        @foreach($clientes as $cliente)
                            <option value="{{ $cliente->id_cliente }}">{{ $cliente->nombre }}</option>
                        @endforeach
                    </select>
                </div>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">ID Pregunta</th>
                            <th scope="col">Pregunta</th>
                            <th scope="col">Respuesta</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($preguntas as $pregunta)
                            <tr>
                                <td>{{ $pregunta->id_pregunta }}</td>
                                <td>{{ $pregunta->pregunta }}</td>
                                <td>
                                    <input type="text" class="form-control" name="respuestas[{{ $pregunta->id_pregunta }}]" required>
                                    <input type="hidden" name="preguntas[{{ $pregunta->id_pregunta }}]" value="{{ $pregunta->id_pregunta }}">
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <button type="submit" class="btn btn-primary">Guardar Detalle de Encuesta</button>
            </form>
        </div>
    </div>
@endsection
