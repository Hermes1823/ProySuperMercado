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
            <h3 id="titulo" class="card-title">Lista de Empleados</h3>
        </div>
        <div class="card-body">
            <button type="button" class="btn btn-primary ms-4" id="btnNewEmplead" data-bs-toggle="modal"
                data-bs-target="#registroModal">
                Registrar Empleado
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
                        <th scope="col">id</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Correo</th>
                        <th scope="col">Rol</th>
                        <th scope="col">Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($Usuarios) <= 0)
                        <tr>
                            <td colspan="4"><b>No hay registros</b></td>
                        </tr>
                    @else
                        @foreach ($Usuarios as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->email }}</td>
                                <td>
                                    @foreach ($Roless as $item2)
                                        @if ($item2->id == $item->idrol)
                                            {{ $item2->rolnombre }}
                                        @break
                                    @endif
                                @endforeach
                            </td>
                            <td>
                                <a href="{{ route('editU', $item->id) }}" class="btn btn-info btn-sm"><i
                                        class="fas fa-edit"></i>Editar</a>
                                <a href="{{ route('confirU', $item->id) }}" class="btn btn-danger btn-sm"><i
                                        class="fas fa-trash"></i>Eliminar</a>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
        {{ $Usuarios->links() }}
    </div>

</div>

<!-- Modal de Registro -->
<div class="modal fade" id="registroModal" tabindex="-1" aria-labelledby="registroModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="background: black">
            <div class="modal-header">
                <h5 class="modal-title" id="registroModalLabel">Registrar Empleado</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Contenido del formulario de registro -->
                <form method="POST" action="{{ route('RegisForUser') }}">
                    @csrf
                    <div id="mensaje">
                        @if (session('datos'))
                            {{ session('datos') }}
                        @endif
                    </div>

                    <!-- Name -->
                    <div class="form-group">
                        <x-input-label for="name" :value="__('Nombre')" />
                        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name"
                            :value="old('name')" required autofocus autocomplete="name" style="color:black" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <!-- Email Address -->
                    <div class="form-group">
                        <x-input-label for="email" :value="__('Correo')" />
                        <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
                            :value="old('email')" required autocomplete="username" style="color:black" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>


                    <!-- Password -->
                    <div class="form-group">
                        <x-input-label for="password" :value="__('Contraseña')" />

                        <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                            autocomplete="new-password" style="color:black" />

                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>
                    <!--Rol Address -->
                    <div class="col-12 form-group">
                        <label class="control-label">Selecionar rol</label><br>
                        <select name="idrol" id="idrol"
                            class="form-control @error('idrol') is-invalid @enderror">
                            @foreach ($Roless as $valorse)
                                @if ($valorse->estado == 1)
                                    <option value="{{ $valorse->id }}">{{ $valorse->rolnombre }}</option>
                                @endif
                            @endforeach
                        </select>
                        @error('idrol')
                            <span class="invalid feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <!-- Confirm Password -->
                    <div class="form-group">
                        <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

                        <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                            name="password_confirmation" required autocomplete="new-password" style="color:black" />

                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>
                    <br>
                    <div class="flex items-center justify-end mt-4">
                        <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                            href="{{ route('login') }}">
                            {{ __('Ya estas Registrado?') }}
                        </a>

                        <x-primary-button class="ml-4">
                            {{ __('Registrarse') }}
                        </x-primary-button>
                    </div>
                    <br>
                </form>
            </div>
            <script>
                function mensaje() {
                $('#idrol').select2();
                }
                setTimeout(mensaje,500);
            </script>
        </div>
    </div>
</div>
</div>

@endsection
