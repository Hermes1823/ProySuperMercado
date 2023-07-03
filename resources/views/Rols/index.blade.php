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
        <div class="card-body">
            <button type="button" class="btn btn-primary ms-4" id="btnNewRol" data-bs-toggle="modal"
                data-bs-target="#registroModal">
                Registrar Rol
            </button>
            <div id="mensaje">
                @if (session('datos'))
                    <div class="alert alert-warning alert-dismissible fade show mt-3 emergente" role="alert"
                        style="color: white; background-color: rgb(31, 183, 39)">
                        {{ session('datos') }}
                    </div>
                @endif
            </div>

            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Nombre</th>
                        <th scope="col">Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($roles) <= 0)
                        <tr>
                            <td colspan="2"><b>No hay registros</b></td>
                        </tr>
                    @else
                        @foreach ($roles as $item)
                            <tr>
                                <td>{{ $item->rolnombre }} </td>
                                <td>
                                    <div class="d-flex justify-content-between">
                                        <a href="{{ route('Roles.edit', $item->id) }}" class="btn btn-info btn-sm mx-1"><i
                                                class="fas fa-edit"></i> Editar</a>
                                        <a href="{{ route('Rol.confirmar', $item->id) }}"
                                            class="btn btn-danger btn-sm mx-1"><i class="fas fa-trash"></i> Eliminar</a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
            {{ $roles->links() }}
        </div>
    </div>

    <!-- Modal de Registro -->
    <div class="modal fade" id="registroModal" tabindex="-1" aria-labelledby="registroModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" style="background: black">
                <div class="modal-header">
                    <h5 class="modal-title" id="registroModalLabel">Registrar Rol</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Contenido del formulario de registro -->
                    <form action="{{ route('Roles.store') }}" method="POST" id="registroForm2">
                        @csrf
                        <div class="form-group">
                            <label class="control-label">Nombre</label>
                            <input type="text" class="form-control" placeholder="Ingrese la rol" name="rolnombre"
                                required>
                        </div>

                        <br>
                        <div>
                            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Guardar</button>
                            <a href="{{ route('Rol.cancelar') }}" class="btn btn-danger" onclick="limpiarFormulario()"
                                data-bs-dismiss="modal">
                                <i class="fas fa-ban"></i> Cancelar
                            </a>
                        </div>
                    </form>
                </div>
                <script>
                    setTimeout(mensaje,500);
                </script>
            </div>
        </div>
    </div>
    <script>
        function limpiarFormulario() {
            document.getElementById("registroForm2").reset();
        }
    </script>
@endsection
