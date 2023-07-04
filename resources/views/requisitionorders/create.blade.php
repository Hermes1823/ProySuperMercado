@extends('dashboard')

@section('css')
    <link rel="stylesheet" href="{{asset('css/requisition-orders/requisition-orders-create.css')}}">
@endsection


@section('contenido')
    @livewire('requisition-orders.requisition-orders-create-component') 
    @livewire('requisition-orders.requisition-orders-create-second-table-component')
@endsection

@section('js')
   <script src={{asset('js/requisition-orders/requisition-orders-create.js')}}></script>
@endsection








