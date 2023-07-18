@extends('dashboard')

@section('titulo', 'INICIO')

@section('contenido')

@error('id_cliente')
<span class="error">{{ $message }}</span>
@enderror

<div class="card">
    <div class="card-header">
        <h3 id="titulo" class="card-title">ENCUESTAS</h3>
    </div>
    <div class="card-body">
        <h4><strong>Nombre de la encuesta:</strong></h4>
        <input type="text" name="nombre_encuesta" class="form-control" placeholder="Ingrese el nombre de la encuesta">

        <div id="mensaje">
            @if (session('datos'))
                <div class="alert alert-warning alert-dismissible fade show mt-3 emergente" role="alert"
                    style="color: white; background-color: rgb(36, 183, 31)">
                    {{ session('datos') }}
                </div>
            @endif
        </div>

        <form action="{{ route('encuesta.store') }}" method="POST">
            @csrf
        
            <div class="form-group">
                <label for="id_cliente">Cliente:</label>
                <select name="id_cliente" class="form-control">
                    <option value="">Seleccionar cliente</option>
                    @foreach ($clientes as $cliente)
                        <option value="{{ $cliente->id_cliente }}">{{ $cliente->nombre }}</option>
                    @endforeach
                </select>
            </div>
        
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Pregunta</th>
                        <th scope="col">Respuesta</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($preguntas as $pregunta)
                        <tr>
                            <td>{{ $pregunta->id_pregunta }}</td>
                            <td>{{ $pregunta->pregunta }}</td>
                            <td>
                                <input type="text" name="respuestas[]" class="form-control">
                                <input type="hidden" name="preguntas[]" value="{{ $pregunta->id_pregunta }}">
                            </td>
                        </tr>
                    @endforeach
                    @if ($preguntas->isEmpty())
                        <tr>
                            <td colspan="3"><b>No hay preguntas disponibles</b></td>
                        </tr>
                    @endif
                </tbody>
            </table>
        
            <button type="submit" class="btn btn-primary">Guardar Encuesta</button>
        </form>
    </div>
</div>

@endsection
