@extends('dashboard')

@section('titulo','Editar Persona')

@section('contenido')
<div class="container">
    <h1 id="titulo" >Editar Montacarga</h1>
    <form method="POST" action="{{route("Montacarga.update",$montacarga->id)}}" enctype="multipart/form-data"  >
        @method('PUT')
        @csrf
        <div class="form-group">
            <label class="control-label">Marca</label>
            <input type="text" style="color: rgb(26, 255, 0)" class="form-control @error('marca') is-invalid @enderror"
                placeholder="Ingrese marca"  value="{{$montacarga->marca}}"  name="marca" required>
            @error('marca')
            <span class="invalid feedback" role="alert">
                <strong>{{$message}}</strong>
            </span>
            @enderror
        </div>
        <div class="form-group">
            <label class="control-label">Altura</label>
            <input type="number" class="form-control @error('altura') is-invalid @enderror"
                placeholder="Ingrese la Altura"  value="{{$montacarga->altura}}" name="altura" required>
            @error('altura')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group">
            <label class="control-label">Capacidad </label>
            <input type="number" class="form-control @error('capacidad') is-invalid @enderror"
                placeholder="Ingrese la Capacidad"  value="{{$montacarga->capacidad}}" name="capacidad">
            @error('capacidad')
            <span class="invalid feedback" role="alert">
                <strong>{{$message}}</strong>
            </span>
            @enderror
        </div>


        <div>Tipo:</div>
        @if($montacarga->tipomontacarga=='AR')
            <div class="form-check">
                <input checked class="form-check-input @error('tipomontacarga') is-invalid @enderror" type="radio"
                        name="tipomontacarga" id="idElectrico" value="AR">
                <label class="form-check-label" for="idElectrico"> Eléctrico </label>
            </div>
            <div class="form-check">
                <input class="form-check-input  @error('tipomontacarga') is-invalid @enderror" type="radio"
                        name="tipomontacarga" id="idContrapeso" value="AL">
                <label class="form-check-label" for="idContrapeso">Contrapeso</label>
            </div>

        @else
            <div class="form-check">
                <input class="form-check-input @error('tipomontacarga') is-invalid @enderror" type="radio"
                        name="tipomontacarga" id="idElectrico" value="AR">
                <label class="form-check-label" for="idElectrico"> Eléctrico </label>
            </div>
            <div class="form-check">
                <input checked class="form-check-input  @error('tipomontacarga') is-invalid @enderror" type="radio"
                        name="tipomontacarga" id="idContrapeso" value="AL">
                <label class="form-check-label" for="idContrapeso"> Contrapeso</label>
            </div>

            @error('tipomontacarga')
                <div class="invalid-feedback">
                    <span>{{$message}}</span>
                </div>
            @enderror
        @endif
        <div class="form-group">
            <div class="col-12 text-center">
                <label class="control-label">Imagen de la Montacarga</label>
                <input type="file"
                    class="form-control @error('file_montacarga') is-invalid @enderror"
                    placeholder="Ingrese Archivo" name="file_montacarga"
                    value="{{ old('file_montacarga') }}" x-data="showImage()"
                    @change="showPreview(event)" accept="image/*">
                <br>
                <img id="preview" src="{{$montacarga->fotomontacarga}}"  alt="Descripción de la imagen"
                    style="max-width: 40%; height: auto;">
                @error('file_montacarga')
                    <span class="invalid feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <br>
            </div>
        </div>

        <div >
            <button class="btn btn-primary"> <i class="fas fa-save"></i>Guardar</button>
            <a href="{{route('Montacarga.cancelar')}}" class="btn btn-danger" > <i class="fas fa-ban"></i>Cancelar</a>
        </div>
    </form>
</div>
<script>
    function showImage() {
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
