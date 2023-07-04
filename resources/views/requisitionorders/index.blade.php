
@extends('dashboard')

@section('titulo', 'Órdenes de Requisición')

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
@endsection

@section('contenido') 
    @livewire('requisition-orders.requisition-orders-component') 
@endsection

@section('js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
   <script src={{asset('js/requisition-orders/requisition-orders-index.js')}}></script>
@endsection