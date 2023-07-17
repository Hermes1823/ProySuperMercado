@extends('dashboard')

@section('contenido')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Editar Pregunta</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('pregunta.update', $pregunta->id_pregunta) }}">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="pregunta">Pregunta</label>
                                <input type="text" class="form-control" id="pregunta" name="pregunta" value="{{ $pregunta->pregunta }}">
                            </div>

                            <!-- Agrega los demás campos de la pregunta aquí -->

                            <button type="submit" class="btn btn-primary">Guardar cambios</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection