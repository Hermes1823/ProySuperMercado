
@extends('dashboard')

@section('titulo', 'Productos')

@section('contenido') 
        @livewire('products.product-component') 
@endsection

@section('js')
   <script type="module" src="js/products/products.js"></script>
@endsection

