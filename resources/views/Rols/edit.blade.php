@extends('dashboard')

@section('titulo','Editar Rol')

@section('contenido')
<div class="container">
    <h1 id="titulo" >Editar Rol</h1>
    <form method="POST" action="{{route("Roles.update",$rol->id)}}"   >
        @method('PUT')
        @csrf
        <div class="form-group">
            <label class="control-label">Nombre del rol</label>
            <input type="text" style="color: rgb(26, 255, 0)" class="form-control @error('rolnombre') is-invalid @enderror"
                placeholder="Ingrese nombre"  value="{{$rol->rolnombre}}"  name="rolnombre" required>
            @error('rolnombre')
            <span class="invalid feedback" role="alert">
                <strong>{{$message}}</strong>
            </span>
            @enderror
        </div>

        <div >
            <button class="btn btn-primary"> <i class="fas fa-save"></i>Guardar</button>
            <a href="{{route('Rol.cancelar')}}" class="btn btn-danger" > <i class="fas fa-ban"></i>Cancelar</a>
        </div>
    </form>
</div>
@endsection
