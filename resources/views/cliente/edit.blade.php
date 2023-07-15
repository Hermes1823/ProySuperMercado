@extends('dashboard')

@section('contenido')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Editar Cliente</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('cliente.update', $cliente->id_cliente) }}">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="nombre">Nombre</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" value="{{ $cliente->nombre }}">
                            </div>

                            <div class="form-group">
                                <label for="apellido">Apellido</label>
                                <input type="text" class="form-control" id="apellido" name="apellido" value="{{ $cliente->apellido }}">
                            </div>

                            <div class="form-group">
                                <label for="telefono">Telefono</label>
                                <input type="text" class="form-control" id="telefono" name="telefono" value="{{ $cliente->telefono }}">
                            </div>

                            <div class="form-group">
                                <label for="correo_electronico">Correo Electronico</label>
                                <input type="text" class="form-control" id="correo_electronico" name="correo_electronico" value="{{ $cliente->correo_electronico }}">
                            </div>

                            <div class="form-group">
                                <label for="direccion_domicilio">Domicilio</label>
                                <input type="text" class="form-control" id="direccion_domicilio" name="direccion_domicilio" value="{{ $cliente->direccion_domicilio }}">
                            </div>

                            <div class="form-group">
                                <label for="fecha_registro">Fecha</label>
                                <input type="text" class="form-control" id="fecha_registro" name="fecha_registro" value="{{ $cliente->fecha_registro }}">
                            </div>


                            <!-- Agrega los demás campos del cliente aquí -->

                            <button type="submit" class="btn btn-primary">Guardar cambios</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
