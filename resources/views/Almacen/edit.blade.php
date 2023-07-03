@extends('dashboard')

@section('titulo','Editar Persona')

@section('contenido')
<div class="container">
    <h1 id="titulo" >Editar Almacen</h1>
    <form method="POST" action="{{route("Almacen.update",$almacen->id)}}">
        @method('PUT')
        @csrf
        <div class="form-group">
            <label class="control-label">Nombre</label>
            <input type="text" style="color: rgb(26, 255, 0)" class="form-control @error('nombre') is-invalid @enderror"
                placeholder="Ingrese nombre"  value="{{$almacen->nombre}}"  name="nombre" disabled>
            @error('nombre')
            <span class="invalid feedback" role="alert">
                <strong>{{$message}}</strong>
            </span>
            @enderror
        </div>

        <div class="form-group">
            <label class="control-label">Ubicacion </label>
            <input type="text" class="form-control @error('ubicacion') is-invalid @enderror"
                placeholder="Ingrese la Ubicacion"  value="{{$almacen->ubicacion}}" name="ubicacion">
            @error('ubicacion')
            <span class="invalid feedback" role="alert">
                <strong>{{$message}}</strong>
            </span>
            @enderror
        </div>

        <div class="form-group">
            <label class="control-label">Capacidad </label>
            <input type="number" class="form-control @error('capacidad') is-invalid @enderror"
                placeholder="Ingrese la Capacidad"  value="{{$almacen->capacidad}}" name="capacidad">
            @error('capacidad')
            <span class="invalid feedback" role="alert">
                <strong>{{$message}}</strong>
            </span>
            @enderror
        </div>


        <div>Tipo:</div>
        @if($almacen->tipoalmacenamiento=='AR')
            <div class="form-check">
                <input checked class="form-check-input @error('tipoalmacenamiento') is-invalid @enderror" type="radio"
                        name="tipoalmacenamiento" id="idArticulos" value="AR">
                <label class="form-check-label" for="idArticulos"> Articulos </label>
            </div>
            <div class="form-check">
                <input class="form-check-input  @error('tipoalmacenamiento') is-invalid @enderror" type="radio"
                        name="tipoalmacenamiento" id="idAlimentos" value="AL">
                <label class="form-check-label" for="idAlimentos">Alimentos</label>
            </div>

        @else
            <div class="form-check">
                <input class="form-check-input @error('tipoalmacenamiento') is-invalid @enderror" type="radio"
                        name="tipoalmacenamiento" id="idArticulos" value="AR">
                <label class="form-check-label" for="idArticulos"> Articulos </label>
            </div>
            <div class="form-check">
                <input checked class="form-check-input  @error('tipoalmacenamiento') is-invalid @enderror" type="radio"
                        name="tipoalmacenamiento" id="idAlimentos" value="AL">
                <label class="form-check-label" for="idAlimentos"> Alimentos</label>
            </div>

            @error('tipoalmacenamiento')
                <div class="invalid-feedback">
                    <span>{{$message}}</span>
                </div>
            @enderror
        @endif

        <div >
            <button class="btn btn-primary"> <i class="fas fa-save"></i>Guardar</button>
            <a href="{{route('Almacen.cancelar')}}" class="btn btn-danger" > <i class="fas fa-ban"></i>Cancelar</a>
        </div>
    </form>
</div>
@endsection
