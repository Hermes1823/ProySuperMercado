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
            <button type="button" class="btn btn-primary ms-4" id="btnNewMontacarga" data-bs-toggle="modal"
                data-bs-target="#registroModal">
                Registrar Montacarga
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
                        <th scope="col">Marca</th>
                        <th scope="col">Altura</th>
                        <th scope="col">Capacidad</th>
                        <th scope="col">Tipo</th>
                        <th scope="col">Foto</th>
                        <th scope="col">Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($montacargas) <= 0)
                        <tr>
                            <td colspan="6"><b>No hay registros</b></td>
                        </tr>
                    @else
                        @foreach ($montacargas as $item)
                            <tr>
                                <td>{{ $item->marca }} </td>
                                <td>{{ $item->altura }}</td>
                                <td>{{ $item->capacidad }}</td>
                                <td>{{ $item->tipomontacarga }}</td>
                                <td style="text-align: center;">
                                    <img src="{{ $item->fotomontacarga }}" style="max-width: 100px; height: auto;">
                                </td>
                                <td>
                                    <div class="d-flex justify-content-between">
                                        <a href="{{ route('Montacarga.edit', $item->id) }}"
                                            class="btn btn-info btn-sm mx-1"><i class="fas fa-edit"></i> Editar</a>
                                        <a href="{{ route('Montacarga.confirmar', $item->id) }}"
                                            class="btn btn-danger btn-sm mx-1"><i class="fas fa-trash"></i> Eliminar</a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
            {{ $montacargas->links() }}
        </div>
    </div>

    <!--Todo Modal de Registro -->
    <div class="modal fade" id="registroModal" tabindex="-1" aria-labelledby="registroModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" style="background: black">
                <div class="modal-header">
                    <h5 class="modal-title" id="registroModalLabel">Registrar Montacarga</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Contenido del formulario de registro -->
                    <form action="{{ route('Montacarga.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label class="control-label">Marca</label>
                            <input type="text" class="form-control @error('marca') is-invalid @enderror"
                                placeholder="Ingrese la Marca" name="marca" required>
                            @error('marca')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="control-label">Altura</label>
                            <input type="number" class="form-control @error('altura') is-invalid @enderror"
                                placeholder="Ingrese la Altura" name="altura" required>
                            @error('altura')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="control-label">Capacidad</label>
                            <input type="number" class="form-control @error('capacidad') is-invalid @enderror"
                                placeholder="Ingrese la Capacidad" name="capacidad" required>
                            @error('capacidad')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="control-label">Tipo</label>
                            <div class="form-check">
                                <input class="form-check-input @error('tipomontacarga') is-invalid @enderror" type="radio"
                                    name="tipomontacarga" id="idElectrico" value="AR" checked>
                                <label class="form-check-label" for="idElectrico">Eléctrico</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input  @error('tipomontacarga') is-invalid @enderror"
                                    type="radio" name="tipomontacarga" id="idContrapeso" value="AL">
                                <label class="form-check-label" for="idContrapeso">Contrapeso</label>
                            </div>
                            @error('tipomontacarga')
                                <div class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <div class="col-12 text-center">
                                <label class="control-label">Imagen de la Montacarga</label>
                                <input type="file" class="form-control @error('file_montacarga') is-invalid @enderror"
                                    placeholder="Ingrese Archivo" name="file_montacarga"
                                    value="{{ old('file_montacarga') }}" x-data="showImageMonta()"
                                    @change="showPreview(event)" accept="image/*">
                                <br>
                                <img id="preview" src="imagenes/Imagen_default.png" alt="Descripción de la imagen"
                                    style="max-width: 40%; height: auto;">
                                @error('file_montacarga')
                                    <span class="invalid feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <br>
                            </div>
                        </div>
                        <br>

                        <div>
                            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Guardar</button>
                            <a href="{{ route('Montacarga.cancelar') }}" class="btn btn-danger" data-bs-dismiss="modal">
                                <i class="fas fa-ban"></i> Cancelar</a>
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
        function showImageMonta() {
            return {
                showPreview(event) {
                    if (event.target.files.length > 0) {
                        var src = URL.createObjectURL(event.target.files[0]);
                        var preview = document.getElementById("preview");
                        preview.src = src;
                        preview.style.display = "block";
                    }
                }
            }
        }
    </script>
@endsection
